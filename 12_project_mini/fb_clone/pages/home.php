<?php
include '../config/db.php';
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: ../auth/login.php");
    exit;
}

// Handle post submission
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $content = trim($_POST['content']);
    $user_id = $_SESSION['user_id'];
    $image = "";

    if(!empty($_FILES['image']['name'])){
        $image = "uploads/" . time() . "_" . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], "../assets/" . $image);
    }

    $stmt = $conn->prepare("INSERT INTO posts (user_id, content, image) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $user_id, $content, $image);
    $stmt->execute();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home | FB Clone</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <header>
        <h2>Facebook Clone</h2>
        <nav>
            <a href="profile.php">Profile</a>
            <a href="../auth/logout.php">Logout</a>
        </nav>
    </header>

    <section class="post-form">
        <form method="POST" enctype="multipart/form-data">
            <textarea name="content" placeholder="What's on your mind?" required></textarea><br>
            <input type="file" name="image" accept="image/*"><br>
            <button type="submit">Post</button>
        </form>
    </section>

    <hr>

    <section class="feed">
        <?php
        $result = $conn->query("SELECT posts.*, users.username FROM posts 
                                JOIN users ON posts.user_id = users.id 
                                ORDER BY posts.created_at DESC");
        while($row = $result->fetch_assoc()): ?>
            <div class="post-card">
                <h3><?= htmlspecialchars($row['username']) ?></h3>
                <p><?= htmlspecialchars($row['content']) ?></p>
                <?php if(!empty($row['image'])): ?>
                    <img src="../assets/<?= htmlspecialchars($row['image']) ?>" class="post-image">
                <?php endif; ?>
                <small><?= $row['created_at'] ?></small>
            </div>
        <?php endwhile; ?>
    </section>
</body>
</html>
