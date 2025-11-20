<link rel="stylesheet" href="/blog-cms/assets/css/style.css">

<?php
require_once '../includes/functions.php';
if(!isLoggedIn() || !isAdmin()) redirect('login.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title    = $_POST['title'];
    $content  = $_POST['content'];
    $category = $_POST['category'];
    $tags     = $_POST['tags'];
    $user_id  = $_SESSION['user_id'];

    $stmt = $conn->prepare("INSERT INTO posts(user_id,title,content,category,tags) VALUES(?,?,?,?,?)");
    $stmt->bind_param("issss", $user_id, $title, $content, $category, $tags);

    if($stmt->execute()){
        redirect("index.php");
    } else {
        $error = "Error adding post!";
    }
}
?>

<?php include '../includes/header.php'; ?>
<h2>Add Post</h2>
<form method="POST">
    <label>Title:</label><br>
    <input type="text" name="title" required><br><br>
    <label>Content:</label><br>
    <textarea name="content" rows="6" required></textarea><br><br>
    <label>Category:</label><br>
    <input type="text" name="category"><br><br>
    <label>Tags (comma separated):</label><br>
    <input type="text" name="tags"><br><br>
    <button type="submit">Add Post</button>
</form>
<?php include '../includes/footer.php'; ?>
