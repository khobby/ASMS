<?php require_once __DIR__ . '/../layouts/header.php'; ?>
<?php require_once __DIR__ . '/../layouts/sidebar.php'; ?>
<h3>Create User</h3>
<form method="post" action="?page=users&action=store">
  <?php echo csrf_token_field(); ?>
  <div class="mb-3"><label>Full Name</label><input name="full_name" class="form-control"></div>
  <div class="mb-3"><label>Email</label><input name="email" class="form-control" type="email"></div>
  <div class="mb-3"><label>Password</label><input name="password" class="form-control" type="password"></div>
  <button class="btn btn-primary">Create</button>
</form>
<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
