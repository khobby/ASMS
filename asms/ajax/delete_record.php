<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';
if ($_SERVER['REQUEST_METHOD']!=='POST') { echo json_encode(['success'=>false]); exit; }
if (empty($_POST['csrf_token']) || $_POST['csrf_token']!==$_SESSION['csrf_token']) { echo json_encode(['success'=>false,'message'=>'CSRF']); exit; }
$type = $_POST['type'] ?? '';
$id = (int)($_POST['id'] ?? 0);
$db = Database::getInstance()->getConnection();
$map = ['incident'=>'incidents','aircraft'=>'aircraft','component'=>'aircraft_components','risk'=>'risks'];
if (!isset($map[$type])) { echo json_encode(['success'=>false]); exit; }
$table = $map[$type];
$stmt = $db->prepare("DELETE FROM $table WHERE id=?");
$stmt->execute([$id]);
echo json_encode(['success'=>true]);
