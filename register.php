<?php
include('config.php');
session_start();

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $have_skill = $_POST['have_skill'] ?? '';
    $want_skill = $_POST['want_skill'] ?? '';

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $check = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        $message = "⚠️ Email already registered.";
    } else {
        $stmt = $conn->prepare("INSERT INTO users (username, email, password, have_skill, want_skill) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $username, $email, $hashed_password, $have_skill, $want_skill);
        if ($stmt->execute()) {
            $message = "✅ Registration successful. <a href='login.php' class='text-decoration-underline'>Login here</a>";
        } else {
            $message = "❌ Registration failed.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register - SkillSwap</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    html, body {
      height: 100%;
      margin: 0;
      background: linear-gradient(135deg, #e0c3fc, #8ec5fc);
      font-family: 'Segoe UI', sans-serif;
      overflow: hidden; /* Prevent scroll */
    }

    .register-container {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100%;
      padding: 20px;
    }

    .register-box {
      background: #ffffffcc;
      backdrop-filter: blur(8px);
      padding: 30px;
      border-radius: 20px;
      max-width: 500px;
      width: 100%;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
      animation: fadeIn 1s ease-in-out;
    }

    .form-control {
      border-radius: 12px;
      padding: 10px 15px;
      border: 1px solid #ced4da;
      transition: box-shadow 0.3s ease;
    }

    .form-control:focus {
      box-shadow: 0 0 8px rgba(142, 197, 252, 0.5);
      border-color: #8ec5fc;
      outline: none;
    }

    .btn-success {
      border-radius: 30px;
      padding: 10px 25px;
      background-color: #6c5ce7;
      border: none;
    }

    .btn-success:hover {
      background-color: #5a4dcf;
    }

    .alert {
      border-radius: 12px;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    a.text-decoration-underline {
      color: #6c5ce7;
    }
  </style>
</head>
<body>

<div class="register-container">
  <div class="register-box">
    <h2 class="text-center mb-4 text-primary"><i class="fas fa-user-plus"></i> Register for <span class="fw-bold">SkillSwap</span></h2>

    <?php if ($message): ?>
      <div class="alert alert-info"><?php echo $message; ?></div>
    <?php endif; ?>

    <form method="POST">
      <div class="mb-3">
        <label class="form-label">Username</label>
        <input type="text" name="username" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Skill You Have</label>
        <input type="text" name="have_skill" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Skill You Want to Learn</label>
        <input type="text" name="want_skill" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-success w-100 mt-2">Register</button>
    </form>

    <p class="mt-3 text-center">
      Already have an account? <a href="login.php" class="fw-semibold text-decoration-underline">Login here</a>
    </p>
  </div>
</div>

</body>
</html>
