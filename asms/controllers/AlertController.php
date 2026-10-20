<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';
class AlertController {
    public function index() {
        $db = Database::getInstance()->getConnection();
        $alerts = $db->query('SELECT al.*, u.full_name AS created_by_name FROM alerts al LEFT JOIN users u ON u.id = al.created_by ORDER BY al.created_at DESC')->fetchAll();
        require __DIR__ . '/../views/alerts/index.php';
    }
}
