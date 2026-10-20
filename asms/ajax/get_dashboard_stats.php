<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';

$db = Database::getInstance()->getConnection();

$totalAcc = (int)$db->query('SELECT COUNT(*) FROM incidents')->fetchColumn();
$stmt = $db->prepare('SELECT COUNT(*) FROM incidents WHERE YEAR(date_occurred)=?');
$stmt->execute([date('Y')]);
$thisYearCount = (int)$stmt->fetchColumn();

$avgFatal = $db->query('SELECT AVG(fatalities) FROM incidents')->fetchColumn();
$atRisk = (int)$db->query("SELECT COUNT(*) FROM aircraft_components WHERE health_score<70")->fetchColumn();
$highRisks = (int)$db->query("SELECT COUNT(*) FROM risks WHERE level='High' OR level='Critical'")->fetchColumn();
$activeAlerts = (int)$db->query("SELECT COUNT(*) FROM alerts WHERE status = 'active'")->fetchColumn();

$stmt2 = $db->prepare('SELECT MONTH(date_occurred) m, COUNT(*) c FROM incidents WHERE YEAR(date_occurred)=? GROUP BY MONTH(date_occurred)');
$stmt2->execute([date('Y')]);
$monthly = $stmt2->fetchAll();

$recentIncidentsStmt = $db->prepare('SELECT COUNT(*) FROM incidents WHERE date_occurred >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)');
$recentIncidentsStmt->execute();
$recentIncidentCount = (int)$recentIncidentsStmt->fetchColumn();

echo json_encode([
    'total_accidents' => $totalAcc,
    'this_year' => $thisYearCount,
    'avg_fatality' => round((float)$avgFatal,2),
    'at_risk' => $atRisk,
    'high_risks' => $highRisks,
    'active_alerts' => $activeAlerts,
    'recent_incidents' => $recentIncidentCount,
    'monthly' => $monthly,
]);
