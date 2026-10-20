<?php
require_once __DIR__ . '/../../config/config.php';
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo APP_NAME; ?> - Forgot Password</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link href="<?php echo BASE_URL; ?>/assets/css/style.css" rel="stylesheet">
  <style>
    body { background: #f0f2f5; }
    .auth-card { border-radius: 20px; box-shadow: 0 20px 60px rgba(13,27,42,.15); }
    .auth-button { background: #0d1b2a; color: #fff; }
    .auth-button:hover { background: #0a1522; }
  </style>
</head>
<body>
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-lg-5">
        <div class="card auth-card p-4">
          <h3 class="mb-3">Forgot Password</h3>
          <p class="text-muted">Enter your email address and we will send reset instructions.</p>
          <form method="post" action="?page=auth&action=forgot_post">
            <?php echo csrf_token_field(); ?>
            <div class="mb-3">
              <label class="form-label">Email address</label>
              <input type="email" name="email" class="form-control form-control-lg" required>
            </div>
            <div class="d-flex justify-content-between align-items-center">
              <a href="?page=auth&action=login" class="text-decoration-none">Back to login</a>
              <button type="submit" class="btn auth-button btn-lg">Send Reset Link</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
