<?php
session_start();
$folder = "uploads/";
$file = basename($_GET['file']);
$path = $folder . $file;

if (!file_exists($path)) {
    die("<h2>⚠️ File not found!</h2>");
}

$ext = pathinfo($file, PATHINFO_EXTENSION);
$content = "";

// Determine how to show the file
if (in_array($ext, ['txt', 'md', 'json', 'html', 'css', 'js', 'php', 'log', 'xml'])) {
    // Read text files safely
    $content = htmlspecialchars(file_get_contents($path));
    $isText = true;
} else {
    $isText = false;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>View File - <?= htmlspecialchars($file) ?></title>
  <link rel="stylesheet" href="style.css">
  <style>
  
</head>
<body>
  <a href="index.php" class="back-btn">← Back to Dashboard</a>

  <div class="viewer">
    <h2>📖 Viewing: <?= htmlspecialchars($file) ?></h2>

    <?php if ($isText): ?>
      <pre><?= $content ?></pre>
    <?php else: ?>
      <p><strong>File Type:</strong> <?= strtoupper($ext) ?></p>
      <p><a href="<?= $path ?>" target="_blank">🔗 Open / Download</a></p>

      <?php if (in_array($ext, ['png', 'jpg', 'jpeg', 'gif', 'webp'])): ?>
        <img src="<?= $path ?>" alt="<?= htmlspecialchars($file) ?>" style="max-width:100%; border-radius:10px;">
      <?php elseif (in_array($ext, ['pdf'])): ?>
        <iframe src="<?= $path ?>" width="100%" height="600px" style="border:none;"></iframe>
      <?php else: ?>
        <p>📁 Preview not available for this file type.</p>
      <?php endif; ?>
    <?php endif; ?>
  </div>
</body>
</html>
