<?php
session_start();
if (!isset($_SESSION['user_id'])) header("Location: login.php");
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $uid = $_SESSION['user_id'];

    $stmt = $conn->prepare("INSERT INTO contacts (user_id, name, phone, email) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $uid, $name, $phone, $email);
    $stmt->execute();
    header("Location: index.php");
    exit();
}
?><!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<form method="post">
    <h2>➕ Add Contact</h2>
    <input type="text" name="name" placeholder="Name" required><br>
    <input type="text" name="phone" placeholder="Phone"><br>
    <input type="email" name="email" placeholder="Email"><br>
    <button type="submit">Save Contact</button>
</form>
<a href="index.php">⬅️ Back</a>

</body>
</html>