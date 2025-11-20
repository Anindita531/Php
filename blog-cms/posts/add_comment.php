<link rel="stylesheet" href="/blog-cms/assets/css/style.css">
<?php
require_once '../includes/functions.php';
if(!isLoggedIn()) redirect('../admin/login.php');

$post_id = $_POST['post_id'];
$comment = $_POST['comment'];
$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("INSERT INTO comments(post_id,user_id,comment) VALUES(?,?,?)");
$stmt->bind_param("iis", $post_id, $user_id, $comment);
$stmt->execute();

redirect("view_post.php?id=$post_id");
?>
