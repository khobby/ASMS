<?php require_once __DIR__ . '/../layouts/header.php'; ?>
<?php require_once __DIR__ . '/../layouts/sidebar.php'; ?>
<div class="d-flex justify-content-between"><h3>Risk Assessment</h3><a class="btn" style="background:#f5a623;color:#0d1b2a;" href="?page=risks&action=create">New Risk</a></div>
<div class="row mt-3">
  <div class="col-md-6"><canvas id="riskMatrix" height="300"></canvas></div>
  <div class="col-md-6"><canvas id="riskDist" height="300"></canvas></div>
</div>
<table class="table mt-3">
  <thead><tr><th>Title</th><th>Category</th><th>Score</th><th>Level</th><th>Status</th></tr></thead>
  <tbody>
  <?php foreach($risks as $r): ?>
    <tr><td><?php echo e($r['title']); ?></td><td><?php echo e($r['category']); ?></td><td><?php echo e($r['risk_score']); ?></td><td><?php echo e($r['level']); ?></td><td><?php echo e($r['status']); ?></td></tr>
  <?php endforeach; ?>
  </tbody>
</table>
<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
