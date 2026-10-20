<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { echo json_encode(['success' => false, 'message' => 'Invalid request']); exit; }
if (empty($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) { echo json_encode(['success' => false, 'message' => 'CSRF token mismatch']); exit; }
$db = Database::getInstance()->getConnection();
$id = (int)($_POST['id'] ?? 0);
$code = $_POST['aircraft_code'] ?? null;
$type = $_POST['aircraft_type'] ?? null;
$manufacturer = $_POST['manufacturer'] ?? null;
$model = $_POST['model'] ?? null;
$serial = $_POST['serial_number'] ?? null;
$registration = $_POST['registration_number'] ?? null;
$status = $_POST['status'] ?? 'active';
if ($id > 0) {
    $stmt = $db->prepare('UPDATE aircraft SET aircraft_code = ?, aircraft_type = ?, manufacturer = ?, model = ?, serial_number = ?, registration_number = ?, status = ? WHERE id = ?');
    $stmt->execute([$code, $type, $manufacturer, $model, $serial, $registration, $status, $id]);
    echo json_encode(['success' => true, 'id' => $id]);
    exit;
}
$stmt = $db->prepare('INSERT INTO aircraft (aircraft_code, aircraft_type, manufacturer, model, serial_number, registration_number, status, created_by) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
$stmt->execute([$code, $type, $manufacturer, $model, $serial, $registration, $status, $_SESSION['user']['id'] ?? null]);
echo json_encode(['success' => true, 'id' => $db->lastInsertId()]);
