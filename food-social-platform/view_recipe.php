
<link  rel="stylesheet" ahref="../assets/css/view_recipe.css";
<?php
include 'includes/db.php';
include 'includes/header.php';
$recipe_id = $_GET['id'];
// Fetch recipe with author and category
$stmt = $conn->prepare("
    SELECT r.*, u.name AS author_name, u.id AS author_id, c.name AS category
    FROM recipes r
    LEFT JOIN users u ON r.user_id = u.id
    LEFT JOIN categories c ON r.category_id = c.id
    WHERE r.id = ?
");
$stmt->bind_param("i", $recipe_id);
$stmt->execute();
$recipe = $stmt->get_result()->fetch_assoc();

// Fetch comments
$comments = $conn->query("
    SELECT cm.*, u.name 
    FROM comments cm 
    JOIN users u ON cm.user_id = u.id 
    WHERE recipe_id = $recipe_id 
    ORDER BY cm.created_at DESC
");

// Fetch cooked images
$cooked = $conn->query("SELECT * FROM cooked_images WHERE recipe_id=$recipe_id ORDER BY created_at DESC");

// Fetch total likes
$likes = $conn->query("SELECT COUNT(*) AS total FROM likes WHERE recipe_id=$recipe_id")->fetch_assoc()['total'];
?>
<div class="recipe-container">
<h1><?= htmlspecialchars($recipe['title']) ?></h1>
<p>
    <strong>By:</strong> <?= htmlspecialchars($recipe['author_name']) ?> 
    | <strong>Category:</strong> <?= htmlspecialchars($recipe['category'] ?? 'Uncategorized') ?>
</p>
<p>
    <strong>Cook Time:</strong> <?= htmlspecialchars($recipe['cook_time']) ?> 
    | <strong>Difficulty:</strong> <?= htmlspecialchars($recipe['difficulty']) ?>
</p>

<?php if($recipe['main_image']): ?>
<img src="assets/images/<?= htmlspecialchars($recipe['main_image']) ?>" width="300">
<?php endif; ?>

<!-- Edit & Delete Buttons -->
<?php if(isset($_SESSION['user_id']) && $_SESSION['user_id'] == $recipe['author_id']): ?>
<div class="btn-group">
    <a href="edit_recipe.php?id=<?= $recipe_id ?>" class="btn btn-edit">Edit</a>
    <a href="delete_recipe.php?id=<?= $recipe_id ?>" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this recipe?');">Delete</a>
</div>
<?php endif; ?>

<!-- Like button -->
<?php if(isset($_SESSION['user_id'])): ?>
<form method="POST" action="like_recipe.php" style="display:inline;">
    <input type="hidden" name="recipe_id" value="<?= $recipe_id ?>">
    <button type="submit" class="btn btn-like">Like (<?= $likes ?>)</button>
</form>
<?php else: ?>
<p>Likes: <?= $likes ?></p>
<?php endif; ?><div style="margin-top:20px;">
    <h3>Share this recipe:</h3>
    
    <!-- Universal Share Button -->
    <button class="btn btn-share" onclick="shareRecipe()">Share</button>
    
    <!-- Social Media Buttons -->
    <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']) ?>" target="_blank" class="btn btn-facebook">Facebook</a>

    <a href="https://twitter.com/intent/tweet?url=<?= urlencode('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']) ?>&text=Check out this amazing recipe!" target="_blank" class="btn btn-twitter">Twitter</a>

    <a href="https://api.whatsapp.com/send?text=Check out this recipe: <?= urlencode('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']) ?>" target="_blank" class="btn btn-whatsapp">WhatsApp</a>
</div>
<div class="recipe-description">
<h2>Description</h2>
<p><?= nl2br(htmlspecialchars($recipe['description'])) ?></p>
</div>
<h3>Comments:</h3>
<?php while($c = $comments->fetch_assoc()): ?>
<p><strong><?= htmlspecialchars($c['name']) ?>:</strong> <?= htmlspecialchars($c['comment']) ?></p>
<?php endwhile; ?>

<?php if(isset($_SESSION['user_id'])): ?>
<h3>Add Comment</h3>
<form method="POST" action="add_comment.php">
    <input type="hidden" name="recipe_id" value="<?= $recipe_id ?>">
    <textarea name="comment" required></textarea><br>
    <button type="submit" class="btn btn-add">Comment</button>
</form>

<a href="upload_cooked.php?recipe_id=<?= $recipe_id ?>" class="btn btn-add">Upload Cooked Image</a>
<?php endif; ?>

<h3>Cooked Photos</h3>
<div class="recipe-grid">
<?php while($img = $cooked->fetch_assoc()): ?>
    <img src="assets/images/<?= htmlspecialchars($img['image']) ?>" width="200">
<?php endwhile; ?>
</div>
</div>
<?php include 'includes/footer.php'; ?><script src="assets/js/script.js"></script>

<script>
function shareRecipe() {
    const recipeUrl = window.location.href;

    if (navigator.share) {
        // Mobile native share
        navigator.share({
            title: 'Check out this recipe!',
            url: recipeUrl
        }).then(() => {
            alert('Thanks for sharing!');
        }).catch(err => console.error(err));
    } else {
        // Desktop fallback: copy URL
        navigator.clipboard.writeText(recipeUrl).then(() => {
            alert('Recipe URL copied to clipboard!');
        }).catch(err => {
            alert('Could not copy URL. Please copy manually: ' + recipeUrl);
        });
    }
}
</script>

<!-- Add some basic styling for buttons -->
<style>
.btn-share, .btn-facebook, .btn-twitter, .btn-whatsapp {
    padding: 8px 15px;
    margin: 5px 5px 5px 0;
    border: none;
    border-radius: 5px;
    color: white;
    cursor: pointer;
    text-decoration: none;
    font-size: 14px;
}

.btn-share { background-color: #007bff; }
.btn-facebook { background-color: #3b5998; }
.btn-twitter { background-color: #1da1f2; }
.btn-whatsapp { background-color: #25d366; }
</style>
