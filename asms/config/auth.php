<?php
// config/auth.php
function ensure_logged_in() {
    if (empty($_SESSION['user'])) {
        header('Location: ' . BASE_URL . '/?page=auth&action=login');
        exit;
    }
}

function current_user() {
    return $_SESSION['user'] ?? null;
}
