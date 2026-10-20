<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';
class SettingsController {
    public function index() {
        $db = Database::getInstance()->getConnection();
        $userId = $_SESSION['user']['id'] ?? null;
        $user = null;
        if ($userId) {
            $stmt = $db->prepare('SELECT * FROM users WHERE id = ?');
            $stmt->execute([$userId]);
            $user = $stmt->fetch();
        }
        require __DIR__ . '/../views/settings/index.php';
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ?page=settings');
            exit;
        }
        if (empty($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            header('Location: ?page=settings&error=csrf');
            exit;
        }
        $db = Database::getInstance()->getConnection();
        $userId = $_SESSION['user']['id'] ?? 0;
        if (!$userId) {
            header('Location: ?page=auth&action=login');
            exit;
        }
        $fullName = trim($_POST['full_name'] ?? ($_SESSION['user']['full_name'] ?? ''));
        $email = trim($_POST['email'] ?? ($_SESSION['user']['email'] ?? ''));
        $updates = ['full_name' => $fullName, 'email' => $email];
        $params = [$fullName, $email];
        if (!empty($_POST['password'])) {
            if (($_POST['password'] ?? '') !== ($_POST['password_confirm'] ?? '')) {
                header('Location: ?page=settings&error=password_mismatch');
                exit;
            }
            $passwordHash = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $updates['password_hash'] = $passwordHash;
            $params[] = $passwordHash;
        }
        $params[] = $userId;
        $sql = 'UPDATE users SET full_name = ?, email = ?';
        if ($passwordHash !== null) {
            $sql .= ', password_hash = ?';
        }
        $sql .= ' WHERE id = ?';
        $stmt = $db->prepare($sql);
        $stmt->execute($params);
        if ($stmt) {
            $_SESSION['user']['full_name'] = $fullName;
            $_SESSION['user']['email'] = $email;
        }
        header('Location: ?page=settings&success=1');
        exit;
    }
}
