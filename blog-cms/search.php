<?php
require_once 'includes/functions.php';

// ===== Get and sanitize keyword =====
$keyword = isset($_GET['q']) ? trim($_GET['q']) : '';
$posts = [];

if(!empty($keyword)){
    $searchTerm = "%$keyword%";

    // ===== Prepared statement to prevent SQL injection =====
    $stmt = $conn->prepare("SELECT * FROM posts WHERE title LIKE ? OR content LIKE ? ORDER BY created_at DESC");
    $stmt->bind_param("ss", $searchTerm, $searchTerm);
    $stmt->execute();
    $posts = $stmt->get_result();
}
?>

<?php include 'includes/header.php'; ?>

<div class="container">
    <h2>Search Posts</h2>

    <form method="GET" action="">
        <input type="text" name="q" placeholder="Search..." value="<?php echo htmlspecialchars($keyword); ?>">
        <button type="submit">Search</button>
    </form>
    <hr>

    <?php if(!empty($keyword)): ?>
        <?php if($posts->num_rows > 0): ?>
            <?php while($row = $posts->fetch_assoc()): ?>
                <div class="post-card">
                    <h3><?php echo htmlspecialchars($row['title']); ?></h3>
                    <p><?php echo htmlspecialchars(substr($row['content'], 0, 150)); ?>...</p>
                    <a class="read-more" href="posts/view_post.php?id=<?php echo $row['id']; ?>">Read More</a>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No posts found for "<b><?php echo htmlspecialchars($keyword); ?></b>".</p>
        <?php endif; ?>
    <?php else: ?>
        <p>Enter a keyword to search posts.</p>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>
