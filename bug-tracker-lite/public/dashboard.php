<?php
require "../config/db.php";
require "../includes/header.php";

$result = $conn->query("SELECT COUNT(*) AS total FROM bugs");
$totalBugs = $result ? $result->fetch_assoc()['total'] : 0;
?>

<h2>Dashboard</h2>
<p>Total Bugs: <?= htmlspecialchars($totalBugs) ?></p>

<?php include "../includes/footer.php"; ?>
