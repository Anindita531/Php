<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FoodFi</title>

    <!-- CORRECT CSS PATH -->
    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>

<header>
    <nav>
        <a href="index.php">Home</a>

        <?php if(isset($_SESSION['user_id'])): ?>
            <a href="add_recipe.php">Add Recipe</a>
            <a href="profile.php?id=<?= $_SESSION['user_id'] ?>">Profile</a>
            <a href="logout.php">Logout</a>
        <?php else: ?>
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
        <?php endif; ?>
    </nav>
</header>

