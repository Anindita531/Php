<?php
include 'db.php';
$id = $_GET['id'];

if (isset($_POST['update'])) {
    $stmt = $conn->prepare("UPDATE contacts SET name=?, phone=? WHERE id=?");
    $stmt->bind_param("ssi", $_POST['name'], $_POST['phone'], $id);
    $stmt->execute();
    header("Location: index.php");
    exit;
}

$result = $conn->query("SELECT * FROM contacts WHERE id=$id");
$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head><title>Update Contact</title></head>
<body>
<h2>✏️ Update Contact</h2>
<form method="post">
  <input type="text" name="name" value="<?= $row['name'] ?>" required>
  <input type="text" name="phone" value="<?= $row['phone'] ?>" required>
  <button type="submit" name="update">Save</button>
</form>
</body>
</html>
