<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';
if ($_SERVER['REQUEST_METHOD']!=='POST') { echo json_encode(['success'=>false]); exit; }
if (empty($_POST['csrf_token']) || $_POST['csrf_token']!==$_SESSION['csrf_token']) { echo json_encode(['success'=>false,'message'=>'CSRF']); exit; }
$db = Database::getInstance()->getConnection();
$stmt = $db->prepare('INSERT INTO maintenance_records (aircraft_id, component_id, maintenance_type, maintenance_date, next_due_date, technician, condition_before, condition_after, notes, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
$stmt->execute([$_POST['aircraft_id']?:null, $_POST['component_id']?:null, $_POST['maintenance_type']?:null, $_POST['maintenance_date']?:null, $_POST['next_due_date']?:null, $_POST['technician']?:null, $_POST['condition_before']?:null, $_POST['condition_after']?:null, $_POST['notes']?:null, $_POST['status']?:'Completed']);
echo json_encode(['success'=>true,'id'=>$db->lastInsertId()]);
