<?php
$currentPage = $_GET['page'] ?? 'dashboard';
$menuItems = [
    'dashboard' => 'Dashboard',
    'incidents' => 'Accident Database',
    'maintenance' => 'Predictive Maintenance',
    'risks' => 'Risk Assessment',
    'aircraft' => 'Aircraft Management',
    'alerts' => 'Safety Alerts',
    'map' => 'Live Tracking',
    'weather' => 'Weather & Routes',
    'reports' => 'Reports',
    'audit' => 'Audit Logs',
    'users' => 'Users',
    'settings' => 'Settings',
];
?>
<div class="offcanvas offcanvas-start bg-dark text-white" tabindex="-1" id="mobileSidebar" aria-labelledby="mobileSidebarLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title text-warning" id="mobileSidebarLabel">Menu</h5>
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <ul class="nav flex-column sidebar-nav">
      <?php foreach ($menuItems as $key => $label): ?>
        <li class="nav-item">
          <a class="nav-link text-white <?php echo $currentPage === $key ? 'active' : ''; ?>" href="?page=<?php echo $key; ?>"><?php echo $label; ?></a>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
</div>

<div class="row g-0 flex-nowrap">
  <div class="col-md-2 d-none d-md-block sidebar-container" style="flex:0 0 auto; width:16.667%;">
    <div class="bg-dark text-white sidebar" style="background:#0d1b2a; min-height:100vh; position:sticky; top:0; padding:1rem 0.5rem; margin-left:0;">
      <h5 class="text-warning" style="padding:0 0.5rem;">Menu</h5>
      <ul class="nav flex-column sidebar-nav" style="padding:0;">
        <?php foreach ($menuItems as $key => $label): ?>
          <li class="nav-item">
            <a class="nav-link text-white <?php echo $currentPage === $key ? 'active' : ''; ?>" href="?page=<?php echo $key; ?>"><?php echo $label; ?></a>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
  <div class="col-md-10 content-area">
