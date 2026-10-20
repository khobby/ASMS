<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';
if ($_SERVER['REQUEST_METHOD']!=='POST') { echo json_encode(['success'=>false]); exit; }
$id = (int)($_POST['id'] ?? 0);
$db = Database::getInstance()->getConnection();
$stmt = $db->prepare('UPDATE notifications SET is_read=1 WHERE id=?');
$stmt->execute([$id]);
echo json_encode(['success'=>true]);
