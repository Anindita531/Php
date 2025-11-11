<?php
session_start();
if (!isset($_SESSION['user_id'])) header("Location: login.php");
include 'config.php';

$id = $_GET['id'];
$uid = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT * FROM contacts WHERE id=? AND user_id=?");
$stmt->bind_param("ii", $id, $uid);
$stmt->execute();
$result = $stmt->get_result();
$contact = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    $update = $conn->prepare("UPDATE contacts SET name=?, phone=?, email=? WHERE id=? AND user_id=?");
    $update->bind_param("sssii", $name, $phone, $email, $id, $uid);
    $update->execute();
    header("Location: index.php");
}
?>
<link rel="stylesheet" href="style.css">
<form method="post">
    <h2>✏️ Edit Contact</h2>
    <input type="text" name="name" value="<?= $contact['name'] ?>" required><br>
    <input type="text" name="phone" value="<?= $contact['phone'] ?>"><br>
    <input type="email" name="email" value="<?= $contact['email'] ?>"><br>
    <button type="submit">Update</button>
</form>
<a href="index.php">⬅️ Back</a>
