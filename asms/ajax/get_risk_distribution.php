<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';
$db = Database::getInstance()->getConnection();
$rows = $db->query("SELECT category, COUNT(*) c FROM risks GROUP BY category")->fetchAll();
echo json_encode($rows);
