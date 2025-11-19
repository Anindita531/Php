<?php
include 'includes/db.php';
include 'includes/header.php';
$recipe_id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM recipes WHERE id=?");
$stmt->bind_param("i",$recipe_id);
$stmt->execute();
$recipe = $stmt->get_result()->fetch_assoc();

// Only allow owner
if($_SESSION['user_id'] != $recipe['user_id']){
    die("Unauthorized");
}

// Handle POST update
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $title = $_POST['title'];
    $description = $_POST['description'];
    $stmt = $conn->prepare("UPDATE recipes SET title=?, description=? WHERE id=?");
    $stmt->bind_param("ssi",$title,$description,$recipe_id);
    $stmt->execute();
    header("Location: view_recipe.php?id=".$recipe_id);
    exit;
}
?>

<form method="POST">
    <input type="text" name="title" value="<?= htmlspecialchars($recipe['title']) ?>" required><br>
    <textarea name="description" required><?= htmlspecialchars($recipe['description']) ?></textarea><br>
    <button type="submit">Update Recipe</button>
</form>
