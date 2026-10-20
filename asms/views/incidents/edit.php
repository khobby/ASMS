<?php require_once __DIR__ . '/../layouts/header.php'; ?>
<?php require_once __DIR__ . '/../layouts/sidebar.php'; ?>
<div class="d-flex justify-content-between align-items-center mb-3">
  <div>
    <h3 class="mb-0">Edit Accident</h3>
    <small class="text-muted">Update the accident details.</small>
  </div>
  <a class="btn btn-outline-secondary" href="?page=incidents">Back to incidents</a>
</div>
<?php if (!$incident): ?>
  <div class="alert alert-warning">Incident not found.</div>
<?php else: ?>
<form id="incident-form" onsubmit="saveIncident(this, function(){ window.location='?page=incidents'; }); return false;">
  <?php echo csrf_token_field(); ?>
  <input type="hidden" name="id" value="<?php echo e($incident['id']); ?>">
  <div class="row g-3">
    <div class="col-md-4"><label class="form-label">Date</label><input type="date" name="date_occurred" class="form-control" value="<?php echo e($incident['date_occurred']); ?>" required></div>
    <div class="col-md-4"><label class="form-label">Severity</label><select name="severity" class="form-select"><option value="Minor" <?php echo $incident['severity']==='Minor' ? 'selected' : ''; ?>>Minor</option><option value="Serious" <?php echo $incident['severity']==='Serious' ? 'selected' : ''; ?>>Serious</option><option value="Critical" <?php echo $incident['severity']==='Critical' ? 'selected' : ''; ?>>Critical</option></select></div>
    <div class="col-md-4"><label class="form-label">Status</label><select name="status" class="form-select"><option value="Open" <?php echo $incident['status']==='Open' ? 'selected' : ''; ?>>Open</option><option value="Investigating" <?php echo $incident['status']==='Investigating' ? 'selected' : ''; ?>>Investigating</option><option value="Closed" <?php echo $incident['status']==='Closed' ? 'selected' : ''; ?>>Closed</option></select></div>
  </div>
  <div class="row g-3 mt-3">
    <div class="col-md-6"><label class="form-label">Incident Type</label><input name="incident_type" class="form-control" value="<?php echo e($incident['incident_type']); ?>" required></div>
    <div class="col-md-6"><label class="form-label">Location</label><input name="location" class="form-control" value="<?php echo e($incident['location']); ?>" required></div>
  </div>
  <div class="row g-3 mt-3">
    <div class="col-md-6"><label class="form-label">Aircraft</label><select name="aircraft_id" class="form-select">
      <option value="">Select aircraft</option>
      <?php foreach ($aircraft as $a): ?><option value="<?php echo $a['id']; ?>" <?php echo $incident['aircraft_id']==$a['id'] ? 'selected' : ''; ?>><?php echo e($a['aircraft_code']); ?></option><?php endforeach; ?>
    </select></div>
    <div class="col-md-6"><label class="form-label">Reported by</label><input name="reported_by" class="form-control" value="<?php echo e($incident['reported_by']); ?>"></div>
  </div>
  <div class="row g-3 mt-3">
    <div class="col-md-3"><label class="form-label">Fatalities</label><input type="number" min="0" name="fatalities" class="form-control" value="<?php echo e($incident['fatalities']); ?>"></div>
    <div class="col-md-3"><label class="form-label">Injuries</label><input type="number" min="0" name="injuries" class="form-control" value="<?php echo e($incident['injuries']); ?>"></div>
    <div class="col-md-6"><label class="form-label">Reported Aircraft</label><input class="form-control" value="<?php echo e($incident['aircraft_code']); ?>" readonly></div>
  </div>
  <div class="mt-3"><label class="form-label">Description</label><textarea name="description" rows="5" class="form-control" required><?php echo e($incident['description']); ?></textarea></div>
  <div class="mt-4"><button type="submit" class="btn btn-primary">Save Changes</button></div>
</form>
<?php endif; ?>
<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
