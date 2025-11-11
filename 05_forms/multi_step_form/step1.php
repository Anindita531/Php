<?php
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $_SESSION['name'] = htmlspecialchars(trim($_POST['name']));
    $_SESSION['email'] = htmlspecialchars(trim($_POST['email']));
    header("Location: step2.php");
    exit();
}
?>

<form method="post" action="">
    <h2>Step 1: Personal Info</h2>
    Name: <input type="text" name="name" required><br>
    Email: <input type="email" name="email" required><br>
    <input type="submit" value="Next">
</form>
