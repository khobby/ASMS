<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';
class MapController {
    public function index() {
        require __DIR__ . '/../views/map/index.php';
    }
}
