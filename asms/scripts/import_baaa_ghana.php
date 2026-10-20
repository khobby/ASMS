<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';

function fetchWithCurlExe($url) {
    $cmd = 'curl.exe -L -A "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0 Safari/537.36" --compressed --silent ' . escapeshellarg($url);
    $output = shell_exec($cmd);
    if ($output === null) {
        throw new RuntimeException('curl.exe fetch failed');
    }
    return $output;
}

function fetchHtml($url) {
    if (function_exists('curl_version')) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0 Safari/537.36');
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        curl_setopt($ch, CURLOPT_ENCODING, '');
        $html = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        if ($html === false || $html === null) {
            $html = null;
        }
    } else {
        $html = null;
    }

    if (!$html || stripos($html, 'Just a moment') !== false || stripos($html, 'cf-browser-verification') !== false) {
        try {
            $html = fetchWithCurlExe($url);
        } catch (RuntimeException $e) {
            // fallback to PHP file_get_contents
            $html = null;
        }
    }

    if (!$html) {
        $context = stream_context_create([
            'http' => [
                'header' => 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0 Safari/537.36\r\n',
                'timeout' => 20,
            ],
            'https' => [
                'header' => 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0 Safari/537.36\r\n',
                'timeout' => 20,
            ],
        ]);
        $html = @file_get_contents($url, false, $context);
    }

    if ($html === false || $html === null) {
        throw new RuntimeException('Failed to fetch HTML from ' . $url);
    }
    return $html;
}

function normalizeText($text) {
    return trim(preg_replace('/\s+/', ' ', strip_tags($text)));
}

function parseResults($html) {
    libxml_use_internal_errors(true);
    $dom = new DOMDocument();
    $dom->loadHTML($html);
    libxml_clear_errors();
    $xpath = new DOMXPath($dom);
    $rows = [];

    foreach ($xpath->query('//table[contains(@class, "table") and contains(@class, "table-hover")]//tbody/tr') as $tr) {
        $tds = $xpath->query('td', $tr);
        if ($tds->length < 7) {
            continue;
        }

        $dateText = normalizeText($tds->item(1)->textContent);
        $operator = normalizeText($tds->item(2)->textContent);
        $aircraft = normalizeText($tds->item(3)->textContent);
        $location = normalizeText($tds->item(4)->textContent);
        $fatalities = (int) normalizeText($tds->item(5)->textContent);
        $registration = normalizeText($tds->item(6)->textContent);
        $linkNode = $xpath->query('.//a', $tds->item(7))->item(0);
        $detailPath = $linkNode ? $linkNode->getAttribute('href') : null;

        if (empty($dateText) || empty($aircraft)) {
            continue;
        }

        $rows[] = [
            'date' => $dateText,
            'operator' => $operator,
            'aircraft' => $aircraft,
            'location' => $location,
            'fatalities' => $fatalities,
            'registration' => $registration,
            'detail_path' => $detailPath,
        ];
    }

    return $rows;
}

function mapSeverity($fatalities) {
    if ($fatalities === 0) {
        return 'Minor';
    }
    if ($fatalities <= 2) {
        return 'Serious';
    }
    return 'Critical';
}

function buildIncidentNumber($row) {
    $slug = null;
    if (!empty($row['detail_path'])) {
        $slug = basename(parse_url($row['detail_path'], PHP_URL_PATH));
    }
    if ($slug) {
        $slug = preg_replace('/[^A-Za-z0-9]+/', '-', trim($slug, '\/')); 
        return 'BAAA-' . strtoupper($slug);
    }
    $date = strtotime($row['date']);
    $reg = preg_replace('/[^A-Za-z0-9]+/', '', strtoupper($row['registration']));
    return 'BAAA-' . date('Ymd', $date) . '-' . ($reg ?: 'UNKNOWN');
}

function getOrCreateAircraftId(PDO $db, array $row) {
    if (empty($row['registration'])) {
        return null;
    }
    $registration = strtoupper($row['registration']);
    $stmt = $db->prepare('SELECT id FROM aircraft WHERE registration_number = ? LIMIT 1');
    $stmt->execute([$registration]);
    $aircraftId = $stmt->fetchColumn();
    if ($aircraftId) {
        return (int) $aircraftId;
    }

    $aircraftCode = preg_replace('/[^A-Za-z0-9]+/', '-', strtoupper(substr($registration, 0, 20)));
    if (empty($aircraftCode)) {
        $aircraftCode = preg_replace('/[^A-Za-z0-9]+/', '-', strtoupper(substr($row['aircraft'], 0, 20)));
    }

    $stmt = $db->prepare('INSERT INTO aircraft (aircraft_code, aircraft_type, manufacturer, model, serial_number, registration_number, status, created_by) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute([
        $aircraftCode,
        $row['aircraft'],
        null,
        $row['aircraft'],
        null,
        $registration,
        'active',
        1,
    ]);
    return (int) $db->lastInsertId();
}

function insertIncident(PDO $db, array $row) {
    $incidentNumber = buildIncidentNumber($row);
    $stmt = $db->prepare('SELECT COUNT(*) FROM incidents WHERE incident_number = ?');
    $stmt->execute([$incidentNumber]);
    if ((int) $stmt->fetchColumn() > 0) {
        return false;
    }

    $date = date('Y-m-d', strtotime($row['date']));
    $severity = mapSeverity($row['fatalities']);
    $aircraftId = getOrCreateAircraftId($db, $row);
    $reportedBy = 1;
    $description = sprintf(
        'Imported from BAAA. Operator: %s. Registration: %s.',
        $row['operator'] ?: 'Unknown',
        $row['registration'] ?: 'N/A'
    );
    $location = $row['location'];
    if (stripos($location, 'ghana') === false) {
        $location = trim($location . ', Ghana');
    }

    $stmt = $db->prepare('INSERT INTO incidents (incident_number, aircraft_id, reported_by, incident_type, severity, location, date_occurred, description, fatalities, injuries, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute([
        $incidentNumber,
        $aircraftId,
        $reportedBy,
        $row['aircraft'],
        $severity,
        $location,
        $date,
        $description,
        $row['fatalities'],
        0,
        'Closed',
    ]);
    return true;
}

$db = Database::getInstance()->getConnection();

$baseUrl = 'https://www.baaa-acro.com/search-results?combine=ghana&order=created&sort=asc';
$inserted = 0;
$skipped = 0;

for ($page = 0; $page <= 4; $page++) {
    $url = $baseUrl . '&page=' . $page;
    echo "Fetching page {$page}...\n";
    try {
        $html = fetchHtml($url);
    } catch (RuntimeException $e) {
        echo 'Fetch failed: ' . $e->getMessage() . "\n";
        break;
    }

    $rows = parseResults($html);
    if (empty($rows)) {
        echo "No records found on page {$page}, stopping.\n";
        break;
    }

    foreach ($rows as $row) {
        if (insertIncident($db, $row)) {
            $inserted++;
            echo 'Inserted: ' . buildIncidentNumber($row) . "\n";
        } else {
            $skipped++;
            echo 'Skipped existing: ' . buildIncidentNumber($row) . "\n";
        }
    }
}

echo "Import complete. Inserted: {$inserted}. Skipped: {$skipped}.\n";
