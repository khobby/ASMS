<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';
class RiskController {
    public function index() {
        $db = Database::getInstance()->getConnection();
        $risks = $db->query('SELECT * FROM risks ORDER BY created_at DESC')->fetchAll();
        require __DIR__ . '/../views/risks/index.php';
    }
    public function create() {
        require __DIR__ . '/../views/risks/create.php';
    }
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ?page=risks');
            exit;
        }
        if (empty($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            header('Location: ?page=risks&error=csrf');
            exit;
        }
        $db = Database::getInstance()->getConnection();
        $likelihood = max(1, min(5, (int)($_POST['likelihood'] ?? 1)));
        $impact = max(1, min(5, (int)($_POST['impact'] ?? 1)));
        $riskScore = $likelihood * $impact;
        $level = 'Low';
        if ($riskScore >= 12) {
            $level = 'Critical';
        } elseif ($riskScore >= 8) {
            $level = 'High';
        } elseif ($riskScore >= 4) {
            $level = 'Medium';
        }
        $stmt = $db->prepare('INSERT INTO risks (title, description, category, likelihood, impact, level, mitigation_plan, owner, status, due_date, created_by) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
        $stmt->execute([
            $_POST['title'] ?: null,
            $_POST['description'] ?: null,
            $_POST['category'] ?: null,
            $likelihood,
            $impact,
            $level,
            $_POST['mitigation_plan'] ?: null,
            $_POST['owner'] ?: null,
            $_POST['status'] ?: 'Open',
            $_POST['due_date'] ?: null,
            $_SESSION['user']['id'] ?? null
        ]);
        header('Location: ?page=risks');
        exit;
    }
}
