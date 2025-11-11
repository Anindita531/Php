<?php
$folder = "uploads/";
$file = basename($_GET['file']);
$path = $folder . $file;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    file_put_contents($path, $_POST['content']);
    echo "<script>alert('✅ File Updated!'); window.location='index.php';</script>";
    exit;
}

$content = file_get_contents($path);
?>
<!DOCTYPE html>
<html>
<head><title>Edit File</title></head>
<body>
<h2>✏️ Editing: <?= $file ?></h2>
<form method="post">
  <textarea name="content" rows="15" cols="80"><?= htmlspecialchars($content) ?></textarea><br><br>
  <button type="submit">Save Changes</button>
</form>
</body>
</html>
