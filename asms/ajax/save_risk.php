<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';
if ($_SERVER['REQUEST_METHOD']!=='POST') { echo json_encode(['success'=>false]); exit; }
if (empty($_POST['csrf_token']) || $_POST['csrf_token']!==$_SESSION['csrf_token']) { echo json_encode(['success'=>false,'message'=>'CSRF']); exit; }
$db = Database::getInstance()->getConnection();
$stmt = $db->prepare('INSERT INTO risks (title, description, category, likelihood, impact, level, mitigation_plan, owner, status, due_date, created_by) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
$stmt->execute([$_POST['title'], $_POST['description'], $_POST['category'], $_POST['likelihood']?:1, $_POST['impact']?:1, $_POST['level']?:'Medium', $_POST['mitigation_plan']?:null, $_POST['owner']?:null, $_POST['status']?:'Open', $_POST['due_date']?:null, $_SESSION['user']['id'] ?? null]);
echo json_encode(['success'=>true,'id'=>$db->lastInsertId()]);
