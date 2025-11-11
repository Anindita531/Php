<?php include 'db.php'; ?>

<!DOCTYPE html>
<html>
<head>
  <title>Contact Book</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<h2>📖 My Contact Book</h2>

<form method="post" action="">
  <input type="text" name="name" placeholder="Name" required>
  <input type="text" name="phone" placeholder="Phone" required>
  <button type="submit" name="add">Add Contact</button>
</form>

<?php
// CREATE
if (isset($_POST['add'])) {
    $stmt = $conn->prepare("INSERT INTO contacts (name, phone) VALUES (?, ?)");
    $stmt->bind_param("ss", $_POST['name'], $_POST['phone']);
    $stmt->execute();
    echo "<p>✅ Contact Added!</p>";
}

// READ
$result = $conn->query("SELECT * FROM contacts");
echo "<table border='1' cellpadding='10'>
<tr><th>ID</th><th>Name</th><th>Phone</th><th>Action</th></tr>";
while ($row = $result->fetch_assoc()) {
    echo "<tr>
      <td>{$row['id']}</td>
      <td>{$row['name']}</td>
      <td>{$row['phone']}</td>
      <td>
        <a href='?delete={$row['id']}'>🗑️</a> |
        <a href='update.php?id={$row['id']}'>✏️</a>
      </td>
    </tr>";
}
echo "</table>";

// DELETE
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM contacts WHERE id=$id");
    header("Location: index.php");
}
?>
</body>
</html>
