<?php require_once __DIR__ . '/../layouts/header.php'; ?>
<?php require_once __DIR__ . '/../layouts/sidebar.php'; ?>
<div class="d-flex justify-content-between align-items-center mb-3">
  <div>
    <h3 class="mb-0">Report Accident</h3>
    <small class="text-muted">Create a new incident record.</small>
  </div>
  <a class="btn btn-outline-secondary" href="?page=incidents">Back to incidents</a>
</div>
<form id="incident-form" onsubmit="saveIncident(this, function(){ window.location='?page=incidents'; }); return false;">
  <?php echo csrf_token_field(); ?>
  <div class="row g-3">
    <div class="col-md-4"><label class="form-label">Date</label><input type="date" name="date_occurred" class="form-control" required></div>
    <div class="col-md-4"><label class="form-label">Severity</label><select name="severity" class="form-select"><option value="Minor">Minor</option><option value="Serious">Serious</option><option value="Critical">Critical</option></select></div>
    <div class="col-md-4"><label class="form-label">Status</label><select name="status" class="form-select"><option value="Open">Open</option><option value="Investigating">Investigating</option><option value="Closed">Closed</option></select></div>
  </div>
  <div class="row g-3 mt-3">
    <div class="col-md-6"><label class="form-label">Incident Type</label><input name="incident_type" class="form-control" required></div>
    <div class="col-md-6"><label class="form-label">Location</label><input name="location" class="form-control" required></div>
  </div>
  <div class="row g-3 mt-3">
    <div class="col-md-6"><label class="form-label">Aircraft</label><select name="aircraft_id" class="form-select">
      <option value="">Select aircraft</option>
      <?php foreach ($aircraft as $a): ?><option value="<?php echo $a['id']; ?>"><?php echo e($a['aircraft_code']); ?></option><?php endforeach; ?>
    </select></div>
    <div class="col-md-6"><label class="form-label">Reported by</label><input name="reported_by" class="form-control"></div>
  </div>
  <div class="row g-3 mt-3">
    <div class="col-md-3"><label class="form-label">Fatalities</label><input type="number" min="0" name="fatalities" class="form-control" value="0"></div>
    <div class="col-md-3"><label class="form-label">Injuries</label><input type="number" min="0" name="injuries" class="form-control" value="0"></div>
  </div>
  <div class="mt-3"><label class="form-label">Description</label><textarea name="description" rows="5" class="form-control" required></textarea></div>
  <div class="mt-4"><button type="submit" class="btn btn-primary">Save Accident</button></div>
</form>
<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
