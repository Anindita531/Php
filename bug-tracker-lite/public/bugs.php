<?php
require "../config/db.php";
require "../includes/header.php";

$bugs = $conn->query("SELECT * FROM bugs ORDER BY created_at DESC");
?>

<h2>All Bugs</h2>
<a href="bug_create.php">+ Create Bug</a>
<table border="1">
<tr>
    <th>ID</th>
    <th>Title</th>
    <th>Priority</th>
    <th>Status</th>
    <th>Actions</th>
</tr>
<?php while($b = $bugs->fetch_assoc()): ?>
<tr>
    <td><?= $b['id'] ?></td>
    <td><?= htmlspecialchars($b['title']) ?></td>
    <td><?= htmlspecialchars($b['priority']) ?></td>
    <td><?= htmlspecialchars($b['status']) ?></td>
    <td>
        <a href="bug_view.php?id=<?= $b['id'] ?>">View</a> |
        <a href="bug_edit.php?id=<?= $b['id'] ?>">Edit</a>
    </td>
</tr>
<?php endwhile; ?>
</table>

<?php include "../includes/footer.php"; ?>

