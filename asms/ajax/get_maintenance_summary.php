<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';
$db = Database::getInstance()->getConnection();
$rows = $db->query('SELECT component_id, COUNT(*) c FROM maintenance_records GROUP BY component_id')->fetchAll();
echo json_encode($rows);
