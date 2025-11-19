<?php
// $recipe should be passed to this include as an associative array
// Example usage: include 'recipes/recipe-details.php'; after fetching $recipe from DB
?>

<div class="recipe-card">
    <?php if(isset($recipe['main_image']) && $recipe['main_image'] != ''): ?>
        <img src="assets/images/<?= $recipe['main_image'] ?>" alt="<?= $recipe['title'] ?>" width="300">
    <?php endif; ?>

    <h2><?= $recipe['title'] ?></h2>
    <p><strong>By:</strong> <?= $recipe['author'] ?? 'Unknown' ?> | 
       <strong>Category:</strong> <?= $recipe['category'] ?? 'Uncategorized' ?></p>
    
    <p><?= substr($recipe['description'], 0, 200) ?>...</p>

    <?php 
    // Likes count
    include 'includes/db.php';
    $likes = $conn->query("SELECT COUNT(*) AS total FROM likes WHERE recipe_id=".$recipe['id'])->fetch_assoc()['total'];

    // Comments count
    $comments = $conn->query("SELECT COUNT(*) AS total FROM comments WHERE recipe_id=".$recipe['id'])->fetch_assoc()['total'];
    ?>

    <p>Likes: <?= $likes ?> | Comments: <?= $comments ?></p>
    <a href="view_recipe.php?id=<?= $recipe['id'] ?>">View Recipe</a>
</div>
