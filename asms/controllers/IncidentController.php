<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';
class IncidentController {
    public function index() {
        $db = Database::getInstance()->getConnection();
        $incidents = $db->query('SELECT i.*, a.aircraft_code FROM incidents i LEFT JOIN aircraft a ON a.id=i.aircraft_id ORDER BY date_occurred DESC')->fetchAll();
        require __DIR__ . '/../views/incidents/index.php';
    }

    public function create() {
        $db = Database::getInstance()->getConnection();
        $aircraft = $db->query('SELECT id, aircraft_code FROM aircraft ORDER BY aircraft_code')->fetchAll();
        require __DIR__ . '/../views/incidents/create.php';
    }

    public function edit() {
        $id = (int)($_GET['id'] ?? 0);
        $db = Database::getInstance()->getConnection();
        $incident = null;
        if ($id) {
            $stmt = $db->prepare('SELECT * FROM incidents WHERE id = ?');
            $stmt->execute([$id]);
            $incident = $stmt->fetch();
        }
        $aircraft = $db->query('SELECT id, aircraft_code FROM aircraft ORDER BY aircraft_code')->fetchAll();
        require __DIR__ . '/../views/incidents/edit.php';
    }

    public function view() {
        $id = (int)($_GET['id'] ?? 0);
        $db = Database::getInstance()->getConnection();
        $incident = null;
        if ($id) {
            $stmt = $db->prepare('SELECT i.*, a.aircraft_code FROM incidents i LEFT JOIN aircraft a ON a.id=i.aircraft_id WHERE i.id = ?');
            $stmt->execute([$id]);
            $incident = $stmt->fetch();
        }
        require __DIR__ . '/../views/incidents/view.php';
    }
}
