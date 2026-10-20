<?php require_once __DIR__ . '/../layouts/header.php'; ?>
<?php require_once __DIR__ . '/../layouts/sidebar.php'; ?>
<h3>Report Hazard</h3>
<form method="post">
  <?php echo csrf_token_field(); ?>
  <div class="mb-3"><label>Title</label><input name="title" class="form-control"></div>
  <div class="mb-3"><label>Description</label><textarea name="description" class="form-control"></textarea></div>
  <button class="btn btn-primary">Save</button>
</form>
<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
