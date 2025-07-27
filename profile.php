<?php
session_start();
include('config.php');

// Redirect if not logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $have_skill = $_POST['have_skill'];
    $want_skill = $_POST['want_skill'];

    $conn->query("
      UPDATE users 
      SET have_skill='$have_skill', want_skill='$want_skill' 
      WHERE username='$username'
    ");
    header("Location: dashboard.php");
    exit();
}

// Fetch current user data
$result = $conn->query("SELECT * FROM users WHERE username='$username'");
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Update Profile | SkillSwap</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(to right, #fcefee, #e0f7fa);
      font-family: 'Segoe UI', sans-serif;
      animation: fadeIn 1s ease-in;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .profile-box {
      background: #ffffffcc;
      backdrop-filter: blur(8px);
      padding: 30px;
      border-radius: 16px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
      max-width: 600px;
      margin: 80px auto;
      animation: fadeIn 0.8s ease-in-out;
    }

    .btn-primary {
      background-color: #6c5ce7;
      border: none;
    }

    .btn-primary:hover {
      background-color: #5a4dcf;
    }

    .form-control {
      border-radius: 8px;
    }

    nav {
      background-color: #fff;
      box-shadow: 0 4px 8px rgba(0,0,0,0.05);
    }

    .navbar-brand {
      font-weight: bold;
      color: #6c5ce7 !important;
    }
  </style>
</head>
<body>

  <!-- Navigation Bar -->
  <nav class="navbar navbar-light px-4">
    <a class="navbar-brand" href="dashboard.php">SkillSwap</a>
    <div>
      <a href="dashboard.php" class="btn btn-outline-secondary btn-sm me-2">Dashboard</a>
      <a href="logout.php" class="btn btn-outline-danger btn-sm">Logout</a>
    </div>
  </nav>

  <!-- Profile Form -->
  <div class="profile-box">
    <h2 class="text-center mb-4">🔧 Update Your Profile</h2>
    <form method="POST">
      <div class="mb-3">
        <label class="form-label">Skill You Have</label>
        <input type="text" name="have_skill" class="form-control" value="<?= htmlspecialchars($user['have_skill']) ?>" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Skill You Want</label>
        <input type="text" name="want_skill" class="form-control" value="<?= htmlspecialchars($user['want_skill']) ?>" required>
      </div>
      <button type="submit" class="btn btn-primary w-100">💾 Save Changes</button>
    </form>
    <div class="text-center mt-3">
      <a href="dashboard.php" class="btn btn-link">← Back to Dashboard</a>
    </div>
  </div>

</body>
</html>
