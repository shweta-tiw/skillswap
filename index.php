<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>SkillSwap - Home</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    body {
      background: linear-gradient(135deg, #e0c3fc, #8ec5fc); /* Pastel gradient */
      font-family: 'Segoe UI', sans-serif;
      min-height: 100vh;
    }

    .navbar {
      background-color: rgba(255, 255, 255, 0.8);
      backdrop-filter: blur(10px);
    }

    .hero {
      padding: 80px 0;
      text-align: center;
      color: #333;
    }

    .hero h1 {
      font-size: 3rem;
      font-weight: bold;
      margin-bottom: 15px;
    }

    .hero p {
      font-size: 1.2rem;
      color: #555;
    }

    .card:hover {
      transform: translateY(-10px);
      transition: all 0.3s ease;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    }

    .btn-custom {
      border-radius: 50px;
      padding: 10px 25px;
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold text-primary" href="#"><i class="fas fa-handshake"></i> SkillSwap</a>
    <div class="ms-auto">
      <?php if (isset($_SESSION['user_id'])): ?>
        <a href="dashboard.php" class="btn btn-info btn-sm btn-custom mx-1"><i class="fas fa-th-large"></i> Dashboard</a>
        <a href="logout.php" class="btn btn-danger btn-sm btn-custom mx-1"><i class="fas fa-sign-out-alt"></i> Logout</a>
      <?php else: ?>
        <a href="register.php" class="btn btn-success btn-sm btn-custom mx-1"><i class="fas fa-user-plus"></i> Register</a>
        <a href="login.php" class="btn btn-primary btn-sm btn-custom mx-1"><i class="fas fa-sign-in-alt"></i> Login</a>
      <?php endif; ?>
    </div>
  </div>
</nav>

<!-- Hero Section -->
<section class="hero">
  <div class="container">
    <h1>Swap Skills, Not Just Ideas</h1>
    <p>Connect with learners & teachers. Empower each other. Grow together 🚀</p>
  </div>
</section>

<!-- Feature Cards -->
<div class="container py-4">
  <div class="row g-4">
    <div class="col-md-4">
      <div class="card h-100 text-center shadow-sm">
        <div class="card-body">
          <i class="fas fa-users fa-3x text-primary mb-3"></i>
          <h5 class="card-title">Find Skill Partners</h5>
          <p class="card-text">Connect with people who have what you want to learn.</p>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card h-100 text-center shadow-sm">
        <div class="card-body">
          <i class="fas fa-exchange-alt fa-3x text-success mb-3"></i>
          <h5 class="card-title">Swap Skills</h5>
          <p class="card-text">Offer your skills and learn something new in return.</p>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card h-100 text-center shadow-sm">
        <div class="card-body">
          <i class="fas fa-chart-line fa-3x text-warning mb-3"></i>
          <h5 class="card-title">Grow Together</h5>
          <p class="card-text">Build confidence, network, and gain practical knowledge.</p>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Footer -->
<footer class="text-center py-4 text-muted">
  &copy; <?= date('Y') ?> SkillSwap. Learn & Grow Together.
</footer>

</body>
</html>
