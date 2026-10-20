<?php require_once __DIR__ . '/../layouts/header.php'; ?>
<?php require_once __DIR__ . '/../layouts/sidebar.php'; ?>
<div class="d-flex justify-content-between align-items-center mb-3">
  <div>
    <h3 class="mb-0">Audit Logs</h3>
    <small class="text-muted">Review recent system events and account activity.</small>
  </div>
</div>
<div class="table-responsive">
  <table class="table table-striped" id="audit-table">
    <thead>
      <tr>
        <th>When</th>
        <th>User</th>
        <th>Event</th>
        <th>Details</th>
      </tr>
    </thead>
    <tbody>
      <?php if (!empty($logs)): ?>
        <?php foreach ($logs as $log): ?>
          <tr>
            <td><?php echo e($log['created_at']); ?></td>
            <td><?php echo e($log['full_name'] ?: 'System'); ?></td>
            <td><?php echo e($log['event'] ?? 'N/A'); ?></td>
            <td><?php echo e($log['details'] ?? '-'); ?></td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr><td colspan="4" class="text-center">No audit records found.</td></tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>
<?php require_once __DIR__ . '/../layouts/footer.php'; ?>

