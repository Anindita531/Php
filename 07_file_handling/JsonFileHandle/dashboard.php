<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}

$user = strtolower($_SESSION['user']);
$dir = "users/$user";
$notes = [];

foreach (glob("$dir/*.json") as $file) {
    $notes[] = json_decode(file_get_contents($file), true);
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Notion-Lite Dashboard</title>
  <link rel="stylesheet" href="assets/styles.css">
</head>
<body>
  <div class="header">
    <h2>Hi, <?= htmlspecialchars($user) ?> 👋</h2>
    <a href="logout.php">Logout</a>
  </div>

  <div class="note-form">
    <input type="text" id="title" placeholder="Title...">
    <textarea id="content" placeholder="Write your note here..."></textarea>
    <button onclick="addNote()">Add Note</button>
  </div>

  <div id="notes-container" class="notes-grid">
    <?php foreach ($notes as $note): ?>
      <div class="note-card" data-id="<?= $note['id'] ?>">
        <h3 contenteditable="true" class="note-title"><?= htmlspecialchars($note['title']) ?></h3>
        <p contenteditable="true" class="note-content"><?= htmlspecialchars($note['content']) ?></p>
        <button onclick="deleteNote('<?= $note['id'] ?>')">🗑️</button>
      </div>
    <?php endforeach; ?>
  </div>

  <script src="assets/script.js"></script>
</body>
</html>
