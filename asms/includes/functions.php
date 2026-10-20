<?php
// includes/functions.php
function e($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

function url($path = '') {
    $base = rtrim(BASE_URL, '/');
    return $base . ($path ? '/' . ltrim($path, '/') : '');
}

function flash_set($key, $val) {
    $_SESSION['flash'][$key] = $val;
}
function flash_get($key) {
    $v = $_SESSION['flash'][$key] ?? null;
    if (isset($_SESSION['flash'][$key])) unset($_SESSION['flash'][$key]);
    return $v;
}
