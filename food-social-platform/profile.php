<?php
include 'includes/db.php';
include 'includes/header.php';

$user_id = $_GET['id'];
$user=$conn->query("SELECT * FROM users WHERE id=$user_id")->fetch_assoc();
$recipes=$conn->query("SELECT * FROM recipes WHERE user_id=$user_id ORDER BY created_at DESC");
?>

<h1><?= $user['name'] ?>'s Profile</h1>
<h2>Recipes:</h2>
<?php while($r=$recipes->fetch_assoc()): ?>
<div class="recipe-card">
    <h3><?= $r['title'] ?></h3>
    <a href="view_recipe.php?id=<?= $r['id'] ?>">View</a>
</div>
<?php endwhile; ?>

<?php include 'includes/footer.php'; ?>
