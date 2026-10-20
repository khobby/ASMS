<?php
require_once __DIR__ . '/../../config/config.php';
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo APP_NAME; ?> - Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <link href="<?php echo BASE_URL; ?>/assets/css/style.css" rel="stylesheet">
  <style>
    body { background: #f0f2f5; }
    .login-card { border-radius: 20px; box-shadow: 0 20px 60px rgba(13,27,42,.15); }
    .login-hero { background-image: url('<?php echo BASE_URL; ?>/assets/images/login-page.jpg'); background-size: cover; background-position: center; min-height: 100vh; position: relative; }
    .login-left { min-height: 100vh; position: relative; }
    .login-brand {
      position: absolute;
      top: 50%;
      left: 2rem;
      transform: translateY(-50%);
      max-width: 360px;
      padding: 1rem;
      background: rgba(0, 0, 0, 0.25);
      border-radius: 16px;
      backdrop-filter: blur(8px);
    }
    .login-logo { max-width: 100%; height: auto; display: block; margin-bottom: 1rem; }
    .login-hero-title {
      font-family: 'Roboto', sans-serif;
      font-size: 28px;
      font-weight: 700;
      color: #fff;
      line-height: 1.2;
      text-shadow: 0 2px 12px rgba(0, 0, 0, 0.45);
    }
    .login-title { font-weight: 700; }
    .login-subtitle { color: #6b7280; }
    .login-button { background: #0d1b2a; color: #fff; }
    .login-button:hover { background: #0a1522; }
  </style>
</head>
<body>
  <div class="container-fluid">
    <div class="row g-0">
      <div class="col-lg-6 d-none d-lg-block login-left login-hero">
        <div class="login-brand">
          <img src="<?php echo BASE_URL; ?>/assets/images/ASMS-main-logo-color.png" alt="ASMS logo" class="login-logo">
          <div class="login-hero-title">Aviation Safety Management System</div>
        </div>
      </div>
      <div class="col-lg-6 d-flex align-items-center justify-content-center">
        <div class="card login-card p-5 m-4" style="max-width:480px; width:100%;">
          <div class="mb-4">
            <h1 class="login-title">ASMS Login</h1>
            <p class="login-subtitle">Secure access to your aviation safety platform.</p>
          </div>
          <form method="post" action="?page=auth&action=login_post">
            <?php echo csrf_token_field(); ?>
            <div class="mb-3">
              <label class="form-label">Email address</label>
              <input type="email" name="email" class="form-control form-control-lg" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Password</label>
              <input type="password" name="password" class="form-control form-control-lg" id="passwordField" required>
            </div>
            <div class="form-check mb-3">
              <input class="form-check-input" type="checkbox" id="showPass" onchange="document.getElementById('passwordField').type=this.checked?'text':'password'">
              <label class="form-check-label" for="showPass">Show Password</label>
            </div>
            <div class="d-grid mb-3">
              <button class="btn login-button btn-lg" type="submit">SIGN IN</button>
            </div>
            <div class="d-flex justify-content-between align-items-center">
              <a href="?page=auth&action=forgot" class="small">Forgot password?</a>
              <span class="text-muted small">Need help? Contact admin.</span>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
