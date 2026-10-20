<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';
$db = Database::getInstance()->getConnection();
$rows = $db->query('SELECT ac.*, a.aircraft_code FROM aircraft_components ac LEFT JOIN aircraft a ON a.id=ac.aircraft_id')->fetchAll();
echo json_encode($rows);
