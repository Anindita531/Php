<?php
require_once __DIR__."/auth.php";
requireLogin();

$user_role = $_SESSION['role'] ?? 'user';
$user_name = $_SESSION['name'] ?? 'Guest';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bug Tracker Lite</title>
    <!-- CSS link -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- Optional: Dark mode JS -->
    <script src="assets/js/script.js" defer></script>
</head>
<body>

<div class="navbar">
    <a href="dashboard.php">Dashboard</a>
    <a href="bugs.php">Bugs</a>
    <?php if($user_role === 'admin'): ?>
        <a href="users.php">Users</a>
    <?php endif; ?>
    <span style="float:right">
        <?= htmlspecialchars($user_name) ?> | <a href="logout.php">Logout</a>
    </span>
</div>

<div class="container">
