<?php require_once __DIR__ . '/../layouts/header.php'; ?>
<?php require_once __DIR__ . '/../layouts/sidebar.php'; ?>
<div class="d-flex justify-content-between align-items-center"><h3>Users</h3><a class="btn btn-sm btn-primary" href="?page=users&action=create">Create User</a></div>
<table class="table mt-3"><thead><tr><th>Name</th><th>Email</th><th>Role</th><th>Status</th></tr></thead><tbody>
<?php foreach($users as $u): ?>
  <tr><td><?php echo e($u['full_name']); ?></td><td><?php echo e($u['email']); ?></td><td><?php echo e($u['role']); ?></td><td><?php echo e($u['status']); ?></td></tr>
<?php endforeach; ?></tbody></table>
<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
