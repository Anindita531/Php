<?php
require "../includes/auth.php";
checkAuth();
require "../config/db.php";
include "../includes/header.php";

$users = $conn->query("SELECT * FROM users ORDER BY id DESC");
?>

<h2>All Users</h2>
<a href="user_create.php">+ Create User</a>

<table border="1">
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Role</th>
    <th>Action</th>
</tr>
<?php while($u = $users->fetch_assoc()): ?>
<tr>
    <td><?= $u['id'] ?></td>
    <td><?= $u['name'] ?></td>
    <td><?= $u['email'] ?></td>
    <td><?= $u['role'] ?></td>
    <td>
        <a href="user_edit.php?id=<?= $u['id'] ?>">Edit</a>
    </td>
</tr>
<?php endwhile; ?>
</table>

<?php include "../includes/footer.php"; ?>
