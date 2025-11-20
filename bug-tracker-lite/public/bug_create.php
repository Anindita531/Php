<?php
require "../config/db.php";
require "../includes/header.php";

if($_SERVER['REQUEST_METHOD']==='POST'){
    $title = $_POST['title'];
    $desc = $_POST['description'];
    $priority = $_POST['priority'];
    $status = 'To Do';

    $stmt = $conn->prepare("INSERT INTO bugs (title, description, priority, status) VALUES (?,?,?,?)");
    $stmt->bind_param("ssss",$title,$desc,$priority,$status);
    $stmt->execute();
    header("Location: bugs.php");
    exit;
}
?>

<h2>Create Bug</h2>
<form method="POST">
    <input type="text" name="title" placeholder="Title" required><br>
    <textarea name="description" placeholder="Description"></textarea><br>
    <select name="priority">
        <option>Low</option>
        <option>Medium</option>
        <option>High</option>
    </select><br>
    <button type="submit">Create</button>
</form>

<?php include "../includes/footer.php"; ?>
