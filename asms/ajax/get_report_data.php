<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';

$db = Database::getInstance()->getConnection();

$start = $_GET['start_date'] ?? null;
$end = $_GET['end_date'] ?? null;
$severity = $_GET['severity'] ?? null;
$aircraft = $_GET['aircraft'] ?? null;

$where = [];
$params = [];

if ($start) { $where[] = 'date_occurred >= ?'; $params[] = $start; }
if ($end) { $where[] = 'date_occurred <= ?'; $params[] = $end; }
if ($severity) { $where[] = 'severity = ?'; $params[] = $severity; }
if ($aircraft) { $where[] = '(aircraft_code = ? OR aircraft = ?)'; $params[] = $aircraft; $params[] = $aircraft; }

$sql = 'SELECT id, date_occurred, incident_type, location, severity, aircraft_code FROM incidents';
if (!empty($where)) { $sql .= ' WHERE ' . implode(' AND ', $where); }
$sql .= ' ORDER BY date_occurred DESC LIMIT 1000';

try {
    $stmt = $db->prepare($sql);
    $stmt->execute($params);
    $rows = $stmt->fetchAll();
    echo json_encode(['data' => $rows, 'count' => count($rows)]);
} catch (Exception $e) {
    // Return empty data on error
    echo json_encode(['data' => [], 'count' => 0, 'error' => $e->getMessage()]);
}

?>
