<?php require_once __DIR__ . '/../layouts/header.php'; ?>
<?php require_once __DIR__ . '/../layouts/sidebar.php'; ?>
<div class="d-flex justify-content-between align-items-center mb-3">
  <div>
    <h3 class="mb-0">Aircraft Management</h3>
    <small class="text-muted">Track aircraft status and registration details.</small>
  </div>
  <a class="btn btn-primary" href="?page=aircraft&action=create">+ Add Aircraft</a>
</div>
<div class="row mb-3">
  <div class="col-md-4">
    <input id="aircraft-search" class="form-control" placeholder="Search aircraft...">
  </div>
</div>
<table class="table table-hover" id="aircraft-table">
  <thead>
    <tr>
      <th>Code</th>
      <th>Type</th>
      <th>Manufacturer</th>
      <th>Model</th>
      <th>Registration</th>
      <th>Status</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($aircraft as $a): ?>
      <tr>
        <td><?php echo e($a['aircraft_code']); ?></td>
        <td><?php echo e($a['aircraft_type']); ?></td>
        <td><?php echo e($a['manufacturer']); ?></td>
        <td><?php echo e($a['model']); ?></td>
        <td><?php echo e($a['registration_number']); ?></td>
        <td><?php echo e(ucfirst($a['status'])); ?></td>
        <td>
          <a class="btn btn-sm btn-outline-secondary me-1" href="?page=aircraft&action=edit&id=<?php echo $a['id']; ?>">Edit</a>
          <button class="btn btn-sm btn-danger" onclick="deleteAircraft(<?php echo $a['id']; ?>)">Delete</button>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<?php require_once __DIR__ . '/../layouts/footer.php'; ?>

