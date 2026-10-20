<?php require_once __DIR__ . '/../layouts/header.php'; ?>
<?php require_once __DIR__ . '/../layouts/sidebar.php'; ?>
<div class="d-flex justify-content-between align-items-center mb-3">
  <div>
    <h3 class="mb-0">Add Aircraft</h3>
    <small class="text-muted">Add a new aircraft to the fleet.</small>
  </div>
  <a class="btn btn-outline-secondary" href="?page=aircraft">Back to list</a>
</div>
<form id="aircraft-form" onsubmit="saveAircraft(this, function(){ window.location='?page=aircraft'; }); return false;">
  <?php echo csrf_token_field(); ?>
  <div class="row g-3">
    <div class="col-md-4"><label class="form-label">Code</label><input name="aircraft_code" class="form-control" required></div>
    <div class="col-md-4"><label class="form-label">Type</label><input name="aircraft_type" class="form-control"></div>
    <div class="col-md-4"><label class="form-label">Manufacturer</label><input name="manufacturer" class="form-control"></div>
  </div>
  <div class="row g-3 mt-3">
    <div class="col-md-4"><label class="form-label">Model</label><input name="model" class="form-control"></div>
    <div class="col-md-4"><label class="form-label">Serial Number</label><input name="serial_number" class="form-control"></div>
    <div class="col-md-4"><label class="form-label">Registration Number</label><input name="registration_number" class="form-control"></div>
  </div>
  <div class="row g-3 mt-3">
    <div class="col-md-4"><label class="form-label">Status</label><select name="status" class="form-select"><option value="active">Active</option><option value="maintenance">Maintenance</option><option value="retired">Retired</option></select></div>
  </div>
  <div class="mt-4"><button type="submit" class="btn btn-primary">Save Aircraft</button></div>
</form>
<?php require_once __DIR__ . '/../layouts/footer.php'; ?>

