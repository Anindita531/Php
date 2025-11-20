<?php
require_once 'config/db.php';

$keyword = isset($_GET['q']) ? $_GET['q'] : '';

$stmt = $conn->prepare("SELECT * FROM posts WHERE title LIKE ? OR content LIKE ? ORDER BY created_at DESC");
$searchTerm = "%$keyword%";
$stmt->bind_param("ss", $searchTerm, $searchTerm);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        echo "<div class='search-item'>";
        echo "<h3>{$row['title']}</h3>";
        echo "<p>".substr($row['content'],0,150)."...</p>";
        echo "<a href='posts/view_post.php?id={$row['id']}'>Read More</a>";
        echo "<hr></div>";
    }
} else {
    echo "<p>No posts found for <strong>".htmlspecialchars($keyword)."</strong></p>";
}
?>
