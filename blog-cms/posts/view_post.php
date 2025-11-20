<?php
require_once '../includes/functions.php';

// ===== Validate and sanitize GET parameter =====
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if($id <= 0){
    die("Invalid post ID.");
}

// ===== Fetch post safely =====
$stmt = $conn->prepare("SELECT * FROM posts WHERE id=? LIMIT 1");
$stmt->bind_param("i", $id);
$stmt->execute();
$post = $stmt->get_result()->fetch_assoc();

if(!$post){
    die("Post not found.");
}

// ===== Fetch comments safely =====
$stmtComments = $conn->prepare("
    SELECT c.comment, u.username 
    FROM comments c 
    JOIN users u ON c.user_id=u.id 
    WHERE c.post_id=? 
    ORDER BY c.created_at DESC
");
$stmtComments->bind_param("i", $id);
$stmtComments->execute();
$comments = $stmtComments->get_result();

?>

<link rel="stylesheet" href="/blog-cms/assets/css/styles.css">

<?php include '../includes/header.php'; ?>

<div class="container post-card">
    <h2><?php echo htmlspecialchars($post['title']); ?></h2>
    <p><?php echo nl2br(htmlspecialchars($post['content'])); ?></p>
    <hr>

    <h3>Comments</h3>
    <?php if($comments->num_rows > 0): ?>
        <?php while($row = $comments->fetch_assoc()): ?>
            <p><b><?php echo htmlspecialchars($row['username']); ?>:</b> 
               <?php echo htmlspecialchars($row['comment']); ?></p>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No comments yet.</p>
    <?php endif; ?>

    <?php if(isLoggedIn()): ?>
        <form method="POST" action="add_comment.php">
            <input type="hidden" name="post_id" value="<?php echo $id; ?>">
            <textarea name="comment" rows="3" required placeholder="Write your comment..."></textarea><br>
            <button type="submit">Add Comment</button>
        </form>
    <?php else: ?>
        <p><a href="../admin/login.php">Login to comment</a></p>
    <?php endif; ?>
</div>

<?php include '../includes/footer.php'; ?>
