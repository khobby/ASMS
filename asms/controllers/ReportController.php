<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';
class ReportController {
    public function index() {
        $db = Database::getInstance()->getConnection();
        $reports = $db->query('SELECT r.*, u.full_name AS generated_by_name FROM reports r LEFT JOIN users u ON u.id = r.generated_by ORDER BY r.created_at DESC')->fetchAll();
        require __DIR__ . '/../views/reports/index.php';
    }
}
