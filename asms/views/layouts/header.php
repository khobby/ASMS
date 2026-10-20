<?php
require_once __DIR__ . '/../../config/config.php';
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo APP_NAME; ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
  <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
  <link href="<?php echo BASE_URL; ?>/assets/css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
  <style>
    .navbar-custom { background-color: #0d1b2a; }
    .brand-gold { color: #f5a623; }
    #tracking-map { width: 100%; height: 520px; min-height: 520px; }
  </style>
</head>
<body style="background:#f0f2f5;">
<script>window.csrf_token = '<?php echo addslashes($_SESSION['csrf_token'] ?? ''); ?>';</script>

<nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
  <div class="container-fluid">
    <div class="d-flex align-items-center">
      <button class="btn btn-outline-light d-md-none me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar" aria-controls="mobileSidebar">
        <i class="bi bi-list"></i>
      </button>
      <a class="navbar-brand mb-0" href="<?php echo BASE_URL; ?>">
        <img src="<?php echo BASE_URL; ?>/assets/images/ASMS-main-logo.png" alt="ASMS logo" class="img-fluid" style="max-height:52px; width:auto;">
      </a>
    </div>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navmenu">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="?page=dashboard">Dashboard</a></li>
        <li class="nav-item"><a class="nav-link" href="?page=incidents">Accident Database</a></li>
        <li class="nav-item"><a class="nav-link" href="?page=maintenance">Predictive Maintenance</a></li>
        <li class="nav-item"><a class="nav-link" href="?page=risks">Risk Assessment</a></li>
        <li class="nav-item"><a class="nav-link" href="?page=map">Live Tracking</a></li>
        <li class="nav-item"><a class="nav-link" href="?page=weather">Weather & Routes</a></li>
      </ul>
      <ul class="navbar-nav ms-auto">
        <li class="nav-item dropdown me-3">
          <a class="nav-link position-relative dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-bell"></i>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">3</span>
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><h6 class="dropdown-header">Notifications</h6></li>
            <li><a class="dropdown-item" href="#">New safety alert available</a></li>
            <li><a class="dropdown-item" href="#">1 incident review pending</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="?page=alerts">View all alerts</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
            <i class="bi bi-person-circle"></i>
            <?php echo htmlspecialchars(isset($_SESSION['user']['full_name']) ? $_SESSION['user']['full_name'] : 'User'); ?>
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="?page=settings">Settings</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="<?php echo BASE_URL; ?>/?page=auth&action=logout">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container-fluid mt-4" style="padding-left:0;padding-right:0;">
