<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';
$db = Database::getInstance()->getConnection();
$stmt = $db->query('SELECT title, message, severity FROM alerts WHERE status = "active" ORDER BY id DESC LIMIT 5');
$rows = $stmt->fetchAll();
echo json_encode($rows);
