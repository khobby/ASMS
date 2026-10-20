<?php require_once __DIR__ . '/../layouts/header.php'; ?>
<?php require_once __DIR__ . '/../layouts/sidebar.php'; ?>
<div class="d-flex justify-content-between align-items-center mb-3">
  <div>
    <h3 class="mb-0">Schedule Maintenance</h3>
    <small class="text-muted">Create a new maintenance record for an aircraft component.</small>
  </div>
  <a class="btn btn-outline-secondary" href="?page=maintenance">Back to maintenance</a>
</div>
<form method="post" action="?page=maintenance&action=store">
  <?php echo csrf_token_field(); ?>
  <div class="row g-3">
    <div class="col-md-4"><label class="form-label">Aircraft</label><select name="aircraft_id" class="form-select" required>
      <option value="">Select aircraft</option>
      <?php foreach($aircraft as $item): ?><option value="<?php echo $item['id']; ?>"><?php echo e($item['aircraft_code']); ?></option><?php endforeach; ?>
    </select></div>
    <div class="col-md-4"><label class="form-label">Component</label><select name="component_id" class="form-select" required>
      <option value="">Select component</option>
      <?php foreach($components as $item): ?><option value="<?php echo $item['id']; ?>"><?php echo e($item['component_name']); ?></option><?php endforeach; ?>
    </select></div>
    <div class="col-md-4"><label class="form-label">Maintenance Type</label><input name="maintenance_type" class="form-control" required></div>
  </div>
  <div class="row g-3 mt-3">
    <div class="col-md-4"><label class="form-label">Maintenance Date</label><input type="date" name="maintenance_date" class="form-control" required></div>
    <div class="col-md-4"><label class="form-label">Next Due Date</label><input type="date" name="next_due_date" class="form-control"></div>
    <div class="col-md-4"><label class="form-label">Technician</label><input name="technician" class="form-control"></div>
  </div>
  <div class="row g-3 mt-3">
    <div class="col-md-6"><label class="form-label">Condition Before</label><textarea name="condition_before" class="form-control" rows="3"></textarea></div>
    <div class="col-md-6"><label class="form-label">Condition After</label><textarea name="condition_after" class="form-control" rows="3"></textarea></div>
  </div>
  <div class="mt-3"><label class="form-label">Notes</label><textarea name="notes" class="form-control" rows="4"></textarea></div>
  <div class="row g-3 mt-3">
    <div class="col-md-4"><label class="form-label">Status</label><select name="status" class="form-select"><option value="Scheduled">Scheduled</option><option value="Completed">Completed</option><option value="In Progress">In Progress</option></select></div>
  </div>
  <div class="mt-4"><button type="submit" class="btn btn-primary">Save Maintenance</button></div>
</form>
<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
