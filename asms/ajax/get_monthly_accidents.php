<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';
$db = Database::getInstance()->getConnection();
$stmt = $db->prepare('SELECT MONTH(date_occurred) m, COUNT(*) c FROM incidents WHERE YEAR(date_occurred)=? GROUP BY MONTH(date_occurred)');
$stmt->execute([date('Y')]);
echo json_encode($stmt->fetchAll());
