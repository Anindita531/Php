<?php
session_start();
include 'includes/db.php';

if(!isset($_SESSION['user_id'])) exit;

$recipe_id = $_POST['recipe_id'];
$user_id = $_SESSION['user_id'];

// Prevent duplicate likes
$stmt = $conn->prepare("SELECT * FROM likes WHERE recipe_id=? AND user_id=?");
$stmt->bind_param("ii",$recipe_id,$user_id);
$stmt->execute();
if($stmt->get_result()->num_rows == 0){
    $stmt = $conn->prepare("INSERT INTO likes(recipe_id,user_id) VALUES(?,?)");
    $stmt->bind_param("ii",$recipe_id,$user_id);
    $stmt->execute();
}

header("Location: view_recipe.php?id=".$recipe_id);
exit;
?>
