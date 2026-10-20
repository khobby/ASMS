<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';
$db = Database::getInstance()->getConnection();
// Build filtered query from GET params
$where = [];
$params = [];
if (!empty($_GET['start_date'])) { $where[] = 'date_occurred >= ?'; $params[] = $_GET['start_date']; }
if (!empty($_GET['end_date'])) { $where[] = 'date_occurred <= ?'; $params[] = $_GET['end_date']; }
if (!empty($_GET['severity'])) { $where[] = 'severity = ?'; $params[] = $_GET['severity']; }
if (!empty($_GET['aircraft'])) { $where[] = '(aircraft_code = ? OR aircraft = ?)'; $params[] = $_GET['aircraft']; $params[] = $_GET['aircraft']; }
$sql = 'SELECT * FROM incidents';
if (!empty($where)) { $sql .= ' WHERE ' . implode(' AND ', $where); }
$sql .= ' ORDER BY date_occurred DESC LIMIT 1000';
$stmt = $db->prepare($sql);
$stmt->execute($params);
$incidents = $stmt->fetchAll();
if (class_exists('\PhpOffice\PhpSpreadsheet\Spreadsheet')) {
    $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->fromArray(['Date','Type','Location','Severity'],NULL,'A1');
    $row = 2;
    foreach($incidents as $i) {
        $sheet->fromArray([$i['date_occurred'],$i['incident_type'],$i['location'],$i['severity']],NULL,'A'.$row);
        $row++;
    }
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="accident_report.xlsx"');
    $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
    $writer->save('php://output');
    exit;
}
// Fallback CSV
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="accident_report.csv"');
$out = fopen('php://output','w');
fputcsv($out, ['Date','Type','Location','Severity']);
foreach($incidents as $i) fputcsv($out, [$i['date_occurred'],$i['incident_type'],$i['location'],$i['severity']]);
fclose($out);
