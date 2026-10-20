<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/auth.php';

class WeatherController {
    public function index() {
        ensure_logged_in();
        require __DIR__ . '/../views/weather/index.php';
    }
}
