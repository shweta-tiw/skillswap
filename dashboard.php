<?php
session_start();
include('config.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

$match_stmt = $conn->prepare("SELECT * FROM users WHERE have_skill = ? AND want_skill = ? AND id != ?");
$match_stmt->bind_param("ssi", $user['want_skill'], $user['have_skill'], $user_id);
$match_stmt->execute();
$matches = $match_stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard - SkillSwap</title>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(to right, #e0f7fa, #fce4ec);
            font-family: 'Segoe UI', sans-serif;
        }
        .navbar {
            background-color: #ffffff;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }
        .navbar-brand {
            font-weight: bold;
            color: #4a148c;
        }
        .dashboard-box {
            max-width: 900px;
            margin: 60px auto;
            background: #ffffff;
            padding: 35px;
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }
        .match-card {
            background-color: #fafafa;
            border-left: 5px solid #64b5f6;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .match-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
        }
        .btn-contact {
            background-color: #4a148c;
            color: white;
            border-radius: 6px;
        }
        .btn-contact:hover {
            background-color: #6a1b9a;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light shadow-sm">
    <div class="container">
         <a class="navbar-brand fw-bold text-primary" href="index.php"><i class="fas fa-handshake"></i> SkillSwap</a>
        <div class="ms-auto">
            <a href="logout.php" class="btn btn-outline-danger btn-sm">Logout</a>
        </div>
    </div>
</nav>

<div class="dashboard-box">
    <h2 class="mb-3 text-center">👋 Welcome, <?php echo htmlspecialchars($user['username']); ?>!</h2>
    <p class="text-center text-muted mb-4">
        You have <strong><?php echo htmlspecialchars($user['have_skill']); ?></strong> & want to learn <strong><?php echo htmlspecialchars($user['want_skill']); ?></strong>.
    </p>

    <h4 class="mb-3">🔍 Matching Users</h4>

    <?php if ($matches->num_rows > 0): ?>
        <?php while ($row = $matches->fetch_assoc()): ?>
            <div class="match-card">
                <h5><?php echo htmlspecialchars($row['username']); ?></h5>
                <p><strong>Has:</strong> <?php echo htmlspecialchars($row['have_skill']); ?></p>
                <p><strong>Wants:</strong> <?php echo htmlspecialchars($row['want_skill']); ?></p>
                <a href="#" class="btn btn-contact btn-sm">Contact</a>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p class="text-muted">😕 No matching users found yet. Try updating your skills.</p>
    <?php endif; ?>
</div>

</body>
</html>
