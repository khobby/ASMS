<?php require_once __DIR__ . '/../layouts/header.php'; ?>
<?php require_once __DIR__ . '/../layouts/sidebar.php'; ?>
<div class="d-flex justify-content-between align-items-center mb-3">
  <div>
    <h3 class="mb-0">Safety Alerts</h3>
    <small class="text-muted">Monitor active alerts and review incident notifications.</small>
  </div>
</div>
<div class="table-responsive">
  <table class="table table-hover" id="alerts-table">
    <thead>
      <tr>
        <th>Title</th>
        <th>Severity</th>
        <th>Status</th>
        <th>Created</th>
        <th>Created By</th>
      </tr>
    </thead>
    <tbody>
      <?php if (!empty($alerts)): ?>
        <?php foreach ($alerts as $alert): ?>
          <tr>
            <td><?php echo e($alert['title']); ?></td>
            <td><span class="badge <?php echo $alert['severity'] === 'High' ? 'bg-danger' : ($alert['severity'] === 'Medium' ? 'bg-warning text-dark' : 'bg-success'); ?>"><?php echo e($alert['severity']); ?></span></td>
            <td><span class="badge <?php echo $alert['status'] === 'active' ? 'bg-success' : 'bg-secondary'; ?>"><?php echo e(ucfirst($alert['status'])); ?></span></td>
            <td><?php echo e($alert['created_at']); ?></td>
            <td><?php echo e($alert['created_by_name'] ?: 'System'); ?></td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr><td colspan="5" class="text-center">No active alerts found.</td></tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>
<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
