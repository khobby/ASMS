<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';
class UserController {
    public function index(){ $db=Database::getInstance()->getConnection(); $users=$db->query('SELECT u.*, r.name role FROM users u LEFT JOIN roles r ON r.id=u.role_id')->fetchAll(); require __DIR__ . '/../views/users/index.php'; }
    public function create(){ require __DIR__ . '/../views/users/create.php'; }
}
