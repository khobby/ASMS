<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';
$db = Database::getInstance()->getConnection();
$stmt = $db->query(
    'SELECT i.date_occurred, CONCAT(a.manufacturer, " ", a.model) AS aircraft, i.location, i.incident_type AS type, i.severity FROM incidents i LEFT JOIN aircraft a ON i.aircraft_id = a.id ORDER BY i.date_occurred DESC LIMIT 5'
);
$rows = $stmt->fetchAll();
echo json_encode($rows);
