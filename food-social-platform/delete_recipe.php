<?php
include 'includes/db.php';
include 'includes/header.php';

$recipe_id = $_GET['id'];

// Check owner
$stmt = $conn->prepare("SELECT user_id FROM recipes WHERE id=?");
$stmt->bind_param("i",$recipe_id);
$stmt->execute();
$recipe = $stmt->get_result()->fetch_assoc();

if($_SESSION['user_id'] == $recipe['user_id']){
    // Delete likes
    $stmt = $conn->prepare("DELETE FROM likes WHERE recipe_id=?");
    $stmt->bind_param("i",$recipe_id);
    $stmt->execute();

    // Delete comments
    $stmt = $conn->prepare("DELETE FROM comments WHERE recipe_id=?");
    $stmt->bind_param("i",$recipe_id);
    $stmt->execute();

    // Delete cooked images
    $stmt = $conn->prepare("DELETE FROM cooked_images WHERE recipe_id=?");
    $stmt->bind_param("i",$recipe_id);
    $stmt->execute();

    // Finally delete recipe
    $stmt = $conn->prepare("DELETE FROM recipes WHERE id=?");
    $stmt->bind_param("i",$recipe_id);
    $stmt->execute();
}

header("Location: index.php");
exit;
?>
