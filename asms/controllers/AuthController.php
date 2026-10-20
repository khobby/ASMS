<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';

class AuthController {
    public function login() {
        require __DIR__ . '/../views/auth/login.php';
    }
    public function login_post() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: ?page=auth&action=login'); exit; }
        if (empty($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) { die('Invalid CSRF'); }
        $email = $_POST['email'] ?? '';
        $pass = $_POST['password'] ?? '';
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare('SELECT * FROM users WHERE email = ? LIMIT 1');
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        if ($user && password_verify($pass, $user['password_hash'])) {
            session_regenerate_id(true);
            $_SESSION['user'] = $user;
            // Track session timing for inactivity and absolute lifetime
            $_SESSION['created'] = time();
            $_SESSION['last_activity'] = time();
            // Optional: store client info for additional checks
            $_SESSION['user_ip'] = $_SERVER['REMOTE_ADDR'] ?? '';
            $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'] ?? '';
            header('Location: ?page=dashboard');
            exit;
        }
        flash_set('error','Invalid credentials');
        header('Location: ?page=auth&action=login');
    }
    public function logout() {
        session_unset();
        session_destroy();
        // Clear session cookie
        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params['path'], $params['domain'],
                $params['secure'], $params['httponly']
            );
        }
        header('Location: ?page=auth&action=login');
        exit;
    }
    public function forgot() {
        require __DIR__ . '/../views/auth/forgot_password.php';
    }
}
