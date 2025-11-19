<?php
include 'includes/header.php';
include 'includes/init.php';
?>

<section class="slider-banner" id="slider-banner">
    <div class="slider-content">
        <h1>Welcome to FoodFi</h1>
        <p>Discover, Cook & Share Delicious Recipes</p>
        <?php if(!isset($_SESSION['user_id'])): ?>
            <a href="register.php" class="slider-btn">Join Now</a>
        <?php endif; ?>
    </div>
</section>



<main>
    <h2>Latest Recipes</h2>
    <div class="recipe-grid">
        <?php
        $result = $conn->query("SELECT r.*, u.name AS author, c.name AS category
                                FROM recipes r
                                LEFT JOIN users u ON r.user_id=u.id
                                LEFT JOIN categories c ON r.category_id=c.id
                                ORDER BY r.created_at DESC LIMIT 8");
        while($recipe = $result->fetch_assoc()):
        ?>
        <div class="recipe-card">
            <img src="/assets/images/<?= $recipe['main_image'] ?? 'default.jpg' ?>" alt="<?= htmlspecialchars($recipe['title']) ?>">
            <h3><?= htmlspecialchars($recipe['title']) ?></h3>
            <p><strong>By:</strong> <?= htmlspecialchars($recipe['author']) ?> | <strong>Category:</strong> <?= htmlspecialchars($recipe['category']) ?></p>
            <p><?= htmlspecialchars(substr($recipe['description'],0,100)) ?>...</p>
            <a href="view_recipe.php?id=<?= $recipe['id'] ?>" class="btn">View Recipe</a>
        </div>
        <?php endwhile; ?>
    </div>
</main>
