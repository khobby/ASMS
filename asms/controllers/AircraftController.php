<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';
class AircraftController {
    public function index() {
        $db = Database::getInstance()->getConnection();
        $aircraft = $db->query('SELECT * FROM aircraft ORDER BY aircraft_code')->fetchAll();
        require __DIR__ . '/../views/aircraft/index.php';
    }

    public function create() {
        require __DIR__ . '/../views/aircraft/create.php';
    }

    public function edit() {
        $id = (int)($_GET['id'] ?? 0);
        $db = Database::getInstance()->getConnection();
        $aircraft = null;
        if ($id) {
            $stmt = $db->prepare('SELECT * FROM aircraft WHERE id = ?');
            $stmt->execute([$id]);
            $aircraft = $stmt->fetch();
        }
        require __DIR__ . '/../views/aircraft/edit.php';
    }
}
