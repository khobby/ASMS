<?php require_once __DIR__ . '/../layouts/header.php'; ?>
<?php require_once __DIR__ . '/../layouts/sidebar.php'; ?>
<?php $user = $user ?? $_SESSION['user'] ?? []; ?>
<div class="mb-4">
  <div class="d-flex justify-content-between align-items-center">
    <div>
      <h3 class="mb-0">Settings</h3>
      <small class="text-muted">Customize your account, privacy controls, and notification preferences.</small>
    </div>
    <div>
      <a class="btn btn-outline-secondary" href="?page=dashboard">Return to Dashboard</a>
    </div>
  </div>
</div>
<?php if (isset($_GET['success'])): ?>
  <div class="alert alert-success">Your account details were updated successfully.</div>
<?php elseif (isset($_GET['error']) && $_GET['error'] === 'csrf'): ?>
  <div class="alert alert-danger">Security token mismatch. Please refresh and try again.</div>
<?php elseif (isset($_GET['error']) && $_GET['error'] === 'password_mismatch'): ?>
  <div class="alert alert-danger">Password and confirmation do not match. Please try again.</div>
<?php endif; ?>
<div class="row gx-4 gy-4">
  <div class="col-lg-6">
    <div class="card p-4">
      <h5>Profile & Security</h5>
      <p class="text-muted">Update your display name, email address, and password with immediate effect.</p>
      <form method="post" action="?page=settings&action=store">
        <?php echo csrf_token_field(); ?>
        <div class="mb-3">
          <label class="form-label">Full Name</label>
          <input type="text" class="form-control" name="full_name" value="<?php echo e($user['full_name'] ?? ''); ?>" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Email address</label>
          <input type="email" class="form-control" name="email" value="<?php echo e($user['email'] ?? ''); ?>" required>
        </div>
        <div class="mb-3">
          <label class="form-label">New password</label>
          <input type="password" class="form-control" name="password" placeholder="Leave blank to keep current password">
        </div>
        <div class="mb-3">
          <label class="form-label">Confirm password</label>
          <input type="password" class="form-control" name="password_confirm" placeholder="Repeat new password">
        </div>
        <div class="text-muted mb-3">Updating your email or password improves account security and lets you manage login access.</div>
        <button type="submit" class="btn btn-primary">Save Profile</button>
      </form>
    </div>
  </div>
  <div class="col-lg-6">
    <div class="card p-4 mb-4">
      <h5>Preferences</h5>
      <p class="text-muted">Choose the interface behavior that helps you work faster without distraction.</p>
      <form id="settings-preferences-form">
        <div class="mb-3">
          <label class="form-label">Default landing page</label>
          <select id="default-page" class="form-select">
            <option value="dashboard">Dashboard</option>
            <option value="incidents">Incidents</option>
            <option value="maintenance">Maintenance</option>
            <option value="alerts">Alerts</option>
          </select>
        </div>
        <div class="form-check mb-2">
          <input class="form-check-input" type="checkbox" id="email-notifications">
          <label class="form-check-label" for="email-notifications">Receive email notifications</label>
        </div>
        <div class="form-check mb-2">
          <input class="form-check-input" type="checkbox" id="compact-navigation">
          <label class="form-check-label" for="compact-navigation">Use compact navigation mode</label>
        </div>
        <div class="form-check mb-2">
          <input class="form-check-input" type="checkbox" id="usage-analytics">
          <label class="form-check-label" for="usage-analytics">Share anonymous usage analytics</label>
        </div>
        <button id="save-settings-preferences" class="btn btn-outline-primary mt-3">Save Preferences</button>
      </form>
    </div>
    <div class="card p-4">
      <h5>Privacy Controls</h5>
      <p class="text-muted">Manage what other users see and how your account information is shared.</p>
      <div class="form-check mb-2">
        <input class="form-check-input" type="checkbox" id="profile-visibility">
        <label class="form-check-label" for="profile-visibility">Allow colleagues to view my profile in reports</label>
      </div>
      <div class="text-muted">Privacy toggles are saved instantly in your browser for a fast personal experience.</div>
    </div>
  </div>
</div>
<?php require_once __DIR__ . '/../layouts/footer.php'; ?>

