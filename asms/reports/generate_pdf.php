<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';
$db = Database::getInstance()->getConnection();
$incidents = $db->query('SELECT * FROM incidents ORDER BY date_occurred DESC LIMIT 100')->fetchAll();
// Try TCPDF if available
if (class_exists('TCPDF')) {
    $pdf = new TCPDF();
    $pdf->AddPage();
    $pdf->SetFont('helvetica','',12);
    $html = '<h2>Accident Report</h2><table border="1" cellpadding="4">';
    $html .= '<tr><th>Date</th><th>Type</th><th>Location</th></tr>';
    foreach($incidents as $i) { $html .= '<tr><td>'.$i['date_occurred'].'</td><td>'.$i['incident_type'].'</td><td>'.$i['location'].'</td></tr>'; }
    $html .= '</table>';
    $pdf->writeHTML($html);
    $pdf->Output('accident_report.pdf','D');
    exit;
}
// Fallback to simple CSV download
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="accident_report.csv"');
$out = fopen('php://output','w');
fputcsv($out, ['Date','Type','Location','Severity']);
foreach($incidents as $i) fputcsv($out, [$i['date_occurred'],$i['incident_type'],$i['location'],$i['severity']]);
fclose($out);
