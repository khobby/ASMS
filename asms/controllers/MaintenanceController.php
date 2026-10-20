<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';
class MaintenanceController {
    public function index(){
        $db = Database::getInstance()->getConnection();
        $components = $db->query('SELECT ac.*, a.aircraft_code FROM aircraft_components ac LEFT JOIN aircraft a ON a.id=ac.aircraft_id')->fetchAll();
        $records = $db->query('SELECT mr.*, a.aircraft_code, c.component_name FROM maintenance_records mr LEFT JOIN aircraft a ON a.id = mr.aircraft_id LEFT JOIN aircraft_components c ON c.id = mr.component_id ORDER BY mr.maintenance_date DESC LIMIT 20')->fetchAll();
        require __DIR__ . '/../views/maintenance/index.php';
    }

    public function create(){
        $db = Database::getInstance()->getConnection();
        $aircraft = $db->query('SELECT id, aircraft_code FROM aircraft ORDER BY aircraft_code')->fetchAll();
        $components = $db->query('SELECT id, component_name FROM aircraft_components ORDER BY component_name')->fetchAll();
        require __DIR__ . '/../views/maintenance/create.php';
    }

    public function store(){
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ?page=maintenance');
            exit;
        }
        require_once __DIR__ . '/../config/config.php';
        require_once __DIR__ . '/../config/database.php';
        if (empty($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            header('Location: ?page=maintenance&error=csrf');
            exit;
        }
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare('INSERT INTO maintenance_records (aircraft_id, component_id, maintenance_type, maintenance_date, next_due_date, technician, condition_before, condition_after, notes, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
        $stmt->execute([
            $_POST['aircraft_id'] ?: null,
            $_POST['component_id'] ?: null,
            $_POST['maintenance_type'] ?: null,
            $_POST['maintenance_date'] ?: null,
            $_POST['next_due_date'] ?: null,
            $_POST['technician'] ?: null,
            $_POST['condition_before'] ?: null,
            $_POST['condition_after'] ?: null,
            $_POST['notes'] ?: null,
            $_POST['status'] ?: 'Scheduled'
        ]);
        header('Location: ?page=maintenance');
        exit;
    }
}
