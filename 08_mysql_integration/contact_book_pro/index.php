<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include 'config.php';
$user_id = $_SESSION['user_id'];

$result = $conn->prepare("SELECT * FROM contacts WHERE user_id = ?");
$result->bind_param("i", $user_id);
$result->execute();
$contacts = $result->get_result();
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<h2>📒 Welcome, <?php echo $_SESSION['username']; ?>!</h2>
<a href="logout.php">Logout</a> | <a href="add_contact.php">➕ Add Contact</a>

<table border="1" cellpadding="10">
<tr><th>Name</th><th>Phone</th><th>Email</th><th>Actions</th></tr>
<?php while($row = $contacts->fetch_assoc()): ?>
<tr>
  <td><?= htmlspecialchars($row['name']); ?></td>
  <td><?= htmlspecialchars($row['phone']); ?></td>
  <td><?= htmlspecialchars($row['email']); ?></td>
  <td>
    <a href="edit_contact.php?id=<?= $row['id']; ?>">✏️ Edit</a> |
    <a href="delete_contact.php?id=<?= $row['id']; ?>" onclick="return confirm('Delete this contact?')">🗑️ Delete</a>
  </td>
</tr>
<?php endwhile; ?>
</table>
</body>
</html>
