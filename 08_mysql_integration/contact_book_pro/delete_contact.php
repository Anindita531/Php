<?php
session_start();
if (!isset($_SESSION['user_id'])) header("Location: login.php");
include 'config.php';

$id = $_GET['id'];
$uid = $_SESSION['user_id'];

$stmt = $conn->prepare("DELETE FROM contacts WHERE id=? AND user_id=?");
$stmt->bind_param("ii", $id, $uid);
$stmt->execute();
header("Location: index.php");
?>
