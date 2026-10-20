<?php require_once __DIR__ . '/../layouts/header.php'; ?>
<?php require_once __DIR__ . '/../layouts/sidebar.php'; ?>
<div class="d-flex justify-content-between align-items-center mb-3">
  <div>
    <h3 class="mb-0">Create Risk</h3>
    <small class="text-muted">Capture a new risk event and mitigation plan.</small>
  </div>
  <a class="btn btn-outline-secondary" href="?page=risks">Back to risk list</a>
</div>
<form method="post" action="?page=risks&action=store">
  <?php echo csrf_token_field(); ?>
  <div class="row g-3">
    <div class="col-md-6"><label class="form-label">Title</label><input name="title" class="form-control" required></div>
    <div class="col-md-6"><label class="form-label">Category</label><input name="category" class="form-control"></div>
  </div>
  <div class="mt-3"><label class="form-label">Description</label><textarea name="description" class="form-control" rows="4"></textarea></div>
  <div class="row g-3 mt-3">
    <div class="col-md-4"><label class="form-label">Likelihood</label><select name="likelihood" class="form-select"><option value="1">1 - Rare</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5 - Almost Certain</option></select></div>
    <div class="col-md-4"><label class="form-label">Impact</label><select name="impact" class="form-select"><option value="1">1 - Low</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5 - Severe</option></select></div>
    <div class="col-md-4"><label class="form-label">Status</label><select name="status" class="form-select"><option value="Open">Open</option><option value="Mitigating">Mitigating</option><option value="Closed">Closed</option></select></div>
  </div>
  <div class="mt-3"><label class="form-label">Mitigation Plan</label><textarea name="mitigation_plan" class="form-control" rows="4"></textarea></div>
  <div class="row g-3 mt-3">
    <div class="col-md-6"><label class="form-label">Owner</label><input name="owner" class="form-control"></div>
    <div class="col-md-6"><label class="form-label">Due Date</label><input type="date" name="due_date" class="form-control"></div>
  </div>
  <div class="mt-4"><button type="submit" class="btn btn-primary">Create Risk</button></div>
</form>
<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
