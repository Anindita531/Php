<?php
session_start();

// Redirect to login if not logged in
if (!isset($_SESSION['username']) && !isset($_COOKIE['username'])) {
    header("Location: index.php");
    exit();
}

// If cookie exists, restore session
if (!isset($_SESSION['username']) && isset($_COOKIE['username'])) {
    $_SESSION['username'] = $_COOKIE['username'];
}

$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        body { font-family: Arial; background: #f9f9f9; text-align:center; padding-top:50px; }
        a { text-decoration:none; color:red; font-weight:bold; }
    </style>
</head>
<body>
    <h1>Welcome, <?php echo htmlspecialchars($username); ?>! 👋</h1>
    <p>This is your dashboard. Only logged-in users can see this page.</p>
    <a href="logout.php">Logout</a>
</body>
</html>
