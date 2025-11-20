<?php
session_start();
require_once '../config/db.php';

// Check if admin is logged in
if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin'){
    header("Location: login.php");
    exit();
}

require_once '../includes/header.php';
?>

<h2>Admin Dashboard</h2>
<p>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>
<ul>
    <li><a href="add_post.php">Manage Post</a></li>
    <!-- Add more admin links like Manage Posts later -->
</ul>
<ul>
    <li><a href="manage_users.php">Manage Users</a></li>
    <!-- Add more admin links like Manage Posts later -->
</ul>

<?php include '../includes/footer.php'; ?>
