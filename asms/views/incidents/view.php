<?php require_once __DIR__ . '/../layouts/header.php'; ?>
<?php require_once __DIR__ . '/../layouts/sidebar.php'; ?>
<?php if (!$incident): ?>
  <div class="alert alert-warning">Incident details are not available.</div>
<?php else: ?>
  <div class="d-flex justify-content-between align-items-center mb-3">
    <div>
      <h3 class="mb-0">Accident Details</h3>
      <small class="text-muted">Review complete incident information.</small>
    </div>
    <div>
      <a class="btn btn-outline-secondary me-2" href="?page=incidents">Back</a>
      <a class="btn btn-primary" href="?page=incidents&action=edit&id=<?php echo $incident['id']; ?>">Edit</a>
    </div>
  </div>
  <div class="card p-4 mb-4">
    <div class="row">
      <div class="col-md-4"><strong>Date:</strong><p><?php echo e($incident['date_occurred']); ?></p></div>
      <div class="col-md-4"><strong>Severity:</strong><p><?php echo e($incident['severity']); ?></p></div>
      <div class="col-md-4"><strong>Status:</strong><p><?php echo e($incident['status']); ?></p></div>
    </div>
    <div class="row mt-3">
      <div class="col-md-4"><strong>Aircraft:</strong><p><?php echo e($incident['aircraft_code']); ?></p></div>
      <div class="col-md-4"><strong>Location:</strong><p><?php echo e($incident['location']); ?></p></div>
      <div class="col-md-4"><strong>Reported by:</strong><p><?php echo e($incident['reported_by']); ?></p></div>
    </div>
    <div class="row mt-3">
      <div class="col-md-3"><strong>Fatalities:</strong><p><?php echo e($incident['fatalities']); ?></p></div>
      <div class="col-md-3"><strong>Injuries:</strong><p><?php echo e($incident['injuries']); ?></p></div>
      <div class="col-md-6"><strong>Type:</strong><p><?php echo e($incident['incident_type']); ?></p></div>
    </div>
    <div class="mt-4"><strong>Description</strong><p><?php echo nl2br(e($incident['description'])); ?></p></div>
  </div>
<?php endif; ?>
<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
