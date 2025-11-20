<?php
require "../includes/auth.php";
checkAuth();
require "../config/db.php";

$id = $_GET['id'] ?? null;
if (!$id) { header("Location: bugs.php"); exit; }

$stmt = $conn->prepare("SELECT * FROM bugs WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$bug = $result->fetch_assoc();

include "../includes/header.php";
?>

<h2>View Bug</h2>
<p><strong>Title:</strong> <?= $bug['title'] ?></p>
<p><strong>Description:</strong> <?= $bug['description'] ?></p>
<p><strong>Priority:</strong> <?= $bug['priority'] ?></p>
<p><strong>Status:</strong> <?= $bug['status'] ?></p>
<p><strong>Created At:</strong> <?= $bug['created_at'] ?></p>

<a href="bugs.php">Back to Bugs</a>

<?php include "../includes/footer.php"; ?>
