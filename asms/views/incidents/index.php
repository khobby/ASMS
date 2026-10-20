<?php require_once __DIR__ . '/../layouts/header.php'; ?>
<?php require_once __DIR__ . '/../layouts/sidebar.php'; ?>
<div class="d-flex justify-content-between align-items-center mb-3">
  <div>
    <h3 class="mb-0">Accident Database</h3>
    <small class="text-muted">Manage reported incidents and review details.</small>
  </div>
  <a class="btn btn-primary" href="?page=incidents&action=create">+ Add Accident</a>
</div>
<div class="row mb-3">
  <div class="col-md-4">
    <input id="incident-search" class="form-control" placeholder="Search accidents...">
  </div>
</div>
<table class="table table-hover" id="incidents-table">
  <thead>
    <tr>
      <th>Date</th>
      <th>Aircraft</th>
      <th>Location</th>
      <th>Type</th>
      <th>Severity</th>
      <th>Casualties</th>
      <th>Status</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($incidents as $inc): ?>
      <tr>
        <td><?php echo e($inc['date_occurred']); ?></td>
        <td><?php echo e($inc['aircraft_code']); ?></td>
        <td><?php echo e($inc['location']); ?></td>
        <td><?php echo e($inc['incident_type']); ?></td>
        <td><span class="badge <?php echo $inc['severity'] === 'Critical' ? 'bg-danger' : ($inc['severity'] === 'Serious' ? 'bg-warning text-dark' : 'bg-success'); ?>"><?php echo e($inc['severity']); ?></span></td>
        <td><?php echo e(($inc['fatalities'] ?? 0) + ($inc['injuries'] ?? 0)); ?></td>
        <td><span class="badge bg-info"><?php echo e($inc['status']); ?></span></td>
        <td>
          <a class="btn btn-sm btn-outline-primary me-1" href="?page=incidents&action=view&id=<?php echo $inc['id']; ?>">View</a>
          <a class="btn btn-sm btn-outline-secondary me-1" href="?page=incidents&action=edit&id=<?php echo $inc['id']; ?>">Edit</a>
          <button class="btn btn-sm btn-danger" onclick="deleteIncident(<?php echo $inc['id']; ?>)">Delete</button>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
