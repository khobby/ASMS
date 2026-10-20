<?php
// config/config.php
define('BASE_URL', '/asms');
define('APP_NAME', 'Aviation Safety Management');
define('APP_SUBTITLE', 'Comprehensive Safety Analysis Platform');

// Session settings
ini_set('session.cookie_httponly', 1);
ini_set('session.use_strict_mode', 1);
// Session lifetime settings
define('SESSION_IDLE_TIMEOUT', 1800); // 30 minutes
define('SESSION_MAX_LIFETIME', 86400); // 24 hours absolute

session_start();

// Initialize session timing values if not set
if (empty($_SESSION['created'])) {
    $_SESSION['created'] = time();
}
if (empty($_SESSION['last_activity'])) {
    $_SESSION['last_activity'] = time();
}

// Enforce idle timeout
if (!empty($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > SESSION_IDLE_TIMEOUT)) {
    // Idle timeout - destroy session
    session_unset();
    session_destroy();
    // Start a fresh session for subsequent pages
    session_start();
}

// Enforce absolute session lifetime
if (!empty($_SESSION['created']) && (time() - $_SESSION['created'] > SESSION_MAX_LIFETIME)) {
    session_unset();
    session_destroy();
    session_start();
}

// Update last activity timestamp on each request
$_SESSION['last_activity'] = time();

// CSRF helpers
if (!function_exists('csrf_token')) {
    function csrf_token() {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }
    function csrf_token_field() {
        $t = htmlspecialchars(csrf_token(), ENT_QUOTES, 'UTF-8');
        return "<input type=\"hidden\" name=\"csrf_token\" value=\"{$t}\">";
    }
}

require_once __DIR__ . '/database.php';
require_once __DIR__ . '/../includes/functions.php';
