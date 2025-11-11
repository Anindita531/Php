<?php
session_start();
$folder = "uploads/";
if (!is_dir($folder)) mkdir($folder);
$files = array_diff(scandir($folder), ['.', '..']);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>📂 File Manager Pro</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>📂 File Manager Pro</h1>

<div class="controls">
  <input type="text" id="search" placeholder="🔍 Search files...">
  <select id="filter">
    <option value="all">All Types</option>
    <option value="txt">.txt</option>
    <option value="md">.md</option>
    <option value="json">.json</option>
  </select>
</div>

<form id="uploadForm" enctype="multipart/form-data">
  <input type="file" name="file" required>
  <button id="uploadBtn" type="submit">⬆️ Upload File</button>
</form>

<hr>

<h2>📋 Uploaded Files</h2>

<div class="file-grid">
  <?php
  if (empty($files)) {
    echo "<p>No files yet. Upload something!</p>";
  } else {
    foreach ($files as $file) {
      echo "
      <div class='file-card' data-name='$file'>
        <p><strong>$file</strong></p>
        <a href='uploads/$file' target='_blank'>📖 View</a> |
        <a href='edit.php?file=$file'>✏️ Edit</a> |
        <a href='delete.php?file=$file' onclick='return confirm(\"Delete $file?\")'>🗑️ Delete</a>
      </div>";
    }
  }
  ?>
</div>

<script src="script.js"></script>
</body>
</html>
