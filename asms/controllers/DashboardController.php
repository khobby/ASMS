<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/auth.php';
class DashboardController {
    public function index() {
        ensure_logged_in();
        require __DIR__ . '/../views/dashboard/index.php';
    }
}
