<?php
// Front controller
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/auth.php';

$page = $_GET['page'] ?? 'dashboard';
$action = $_GET['action'] ?? 'index';

if (empty($_SESSION['user']) && $page !== 'auth') {
    header('Location: ?page=auth&action=login');
    exit;
}

$controllers = [
    'auth' => 'AuthController',
    'dashboard' => 'DashboardController',
    'aircraft' => 'AircraftController',
    'incidents' => 'IncidentController',
    'risks' => 'RiskController',
    'maintenance' => 'MaintenanceController',
    'alerts' => 'AlertController',
    'reports' => 'ReportController',
    'users' => 'UserController',
    'audit' => 'AuditController',
    'hazards' => 'HazardController',
    'compliance' => 'ComplianceController',
    'settings' => 'SettingsController',
    'map' => 'MapController',
    'weather' => 'WeatherController',
];

$controllerFile = __DIR__ . '/controllers/' . ($controllers[$page] ?? 'DashboardController') . '.php';
if (file_exists($controllerFile)) {
    require_once $controllerFile;
    $class = $controllers[$page] ?? 'DashboardController';
    if (class_exists($class)) {
        $ctrl = new $class();
        if (method_exists($ctrl, $action)) {
            $ctrl->{$action}();
            exit;
        }
    }
}

// Default: show dashboard view
require_once __DIR__ . '/views/dashboard/index.php';
