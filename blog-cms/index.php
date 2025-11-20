<?php
session_start();
require_once 'config/db.php';
require_once 'includes/header.php';
?>

<div class="container">

    <h1>Welcome to Blog CMS</h1>

    <!-- Search -->
    <div class="search-box">
        <input type="text" name="q" placeholder="Search posts..." id="searchInput">
    </div>
    <div id="search-results"></div>

    <!-- Recent Posts -->
    <section class="posts-section">
        <h2>Recent Posts</h2>
        <?php
        $stmt = $conn->prepare("SELECT p.id,p.title,p.content,u.username,p.created_at 
                                FROM posts p JOIN users u ON p.user_id=u.id 
                                ORDER BY p.created_at DESC LIMIT 5");
        $stmt->execute();
        $result = $stmt->get_result();
        while($post = $result->fetch_assoc()):
        ?>
        <div class="post-card">
            <h3><?php echo htmlspecialchars($post['title']); ?></h3>
            <p class="meta">by <strong><?php echo htmlspecialchars($post['username']); ?></strong> on <?php echo $post['created_at']; ?></p>
            <p><?php echo substr($post['content'],0,200); ?>...</p>
            <a class="read-more" href="posts/view_post.php?id=<?php echo $post['id']; ?>">Read More</a>
        </div>
        <?php endwhile; ?>
    </section>

    <!-- Categories -->
    <section class="categories-section">
        <h2>Categories</h2>
        <?php
        $cats = $conn->query("SELECT DISTINCT category FROM posts WHERE category IS NOT NULL");
        while($c = $cats->fetch_assoc()){
            echo "<span class='category'>".htmlspecialchars($c['category'])."</span> ";
        }
        ?>
    </section>

    <!-- Most Commented -->
    <section class="most-commented-section">
        <h2>Most Commented</h2>
        <?php
        $most = $conn->query("SELECT p.id,p.title,COUNT(c.id) AS total_comments 
        FROM posts p LEFT JOIN comments c ON p.id=c.post_id 
        GROUP BY p.id ORDER BY total_comments DESC LIMIT 5");
        while($m = $most->fetch_assoc()){
            echo "<p><a href='posts/view_post.php?id={$m['id']}'>".htmlspecialchars($m['title'])."</a> ({$m['total_comments']} comments)</p>";
        }
        ?>
    </section>

</div>

<?php include 'includes/footer.php'; ?>
