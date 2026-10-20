<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { echo json_encode(['success' => false, 'message' => 'Invalid request']); exit; }
if (empty($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) { echo json_encode(['success' => false, 'message' => 'CSRF token mismatch']); exit; }
$db = Database::getInstance()->getConnection();
$id = (int)($_POST['id'] ?? 0);
$aircraftId = $_POST['aircraft_id'] ?: null;
$reportedBy = $_POST['reported_by'] ?: null;
$severity = $_POST['severity'] ?: 'Minor';
$location = $_POST['location'] ?: null;
date_default_timezone_set('UTC');
$dateOccurred = $_POST['date_occurred'] ?: date('Y-m-d');
$description = $_POST['description'] ?: null;
$fatalities = isset($_POST['fatalities']) ? (int)$_POST['fatalities'] : 0;
$injuries = isset($_POST['injuries']) ? (int)$_POST['injuries'] : 0;
$status = $_POST['status'] ?: 'Open';
if ($id > 0) {
    $stmt = $db->prepare('UPDATE incidents SET aircraft_id = ?, reported_by = ?, incident_type = ?, severity = ?, location = ?, date_occurred = ?, description = ?, fatalities = ?, injuries = ?, status = ? WHERE id = ?');
    $stmt->execute([$aircraftId, $reportedBy, $_POST['incident_type'] ?: null, $severity, $location, $dateOccurred, $description, $fatalities, $injuries, $status, $id]);
    echo json_encode(['success' => true, 'id' => $id]);
    exit;
}
$stmt = $db->prepare('INSERT INTO incidents (incident_number, aircraft_id, reported_by, incident_type, severity, location, date_occurred, description, fatalities, injuries, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
$num = 'INC-' . time();
$stmt->execute([$num, $aircraftId, $reportedBy, $_POST['incident_type'] ?: null, $severity, $location, $dateOccurred, $description, $fatalities, $injuries, $status]);
echo json_encode(['success' => true, 'id' => $db->lastInsertId()]);
