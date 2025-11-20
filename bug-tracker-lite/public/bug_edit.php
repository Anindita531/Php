<?php
require "../includes/auth.php";
checkAuth();
require "../config/db.php";

$id = $_GET['id'] ?? null;
if (!$id) { header("Location: bugs.php"); exit; }

$stmt = $conn->prepare("SELECT * FROM bugs WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$bug = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $title = $_POST['title'];
    $desc = $_POST['description'];
    $priority = $_POST['priority'];
    $status = $_POST['status'];

    $update = $conn->prepare("UPDATE bugs SET title=?, description=?, priority=?, status=? WHERE id=?");
    $update->bind_param("ssssi", $title, $desc, $priority, $status, $id);
    $update->execute();

    header("Location: bugs.php");
    exit;
}
?>
<?php include "../includes/header.php"; ?>

<h2>Edit Bug</h2>
<form method="POST">
    <input type="text" name="title" value="<?= $bug['title'] ?>" required><br>
    <textarea name="description"><?= $bug['description'] ?></textarea><br>
    <select name="priority">
        <option <?= $bug['priority']=='Low'?'selected':'' ?>>Low</option>
        <option <?= $bug['priority']=='Medium'?'selected':'' ?>>Medium</option>
        <option <?= $bug['priority']=='High'?'selected':'' ?>>High</option>
    </select><br>
    <select name="status">
        <option <?= $bug['status']=='To Do'?'selected':'' ?>>To Do</option>
        <option <?= $bug['status']=='In Progress'?'selected':'' ?>>In Progress</option>
        <option <?= $bug['status']=='Resolved'?'selected':'' ?>>Resolved</option>
    </select><br>
    <button type="submit">Update</button>
</form>

<?php include "../includes/footer.php"; ?>
