<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';
$db = Database::getInstance()->getConnection();
$rows = $db->query('SELECT * FROM risks ORDER BY created_at DESC')->fetchAll();
echo json_encode($rows);
