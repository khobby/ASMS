<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';
$db = Database::getInstance()->getConnection();
$inc = $db->query('SELECT i.*, a.aircraft_code FROM incidents i LEFT JOIN aircraft a ON a.id=i.aircraft_id ORDER BY date_occurred DESC')->fetchAll();
echo json_encode($inc);
