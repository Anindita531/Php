<?php
$filename = "notes.txt";

// ✅ Create file if not exists
if(!file_exists($filename)){
    file_put_contents($filename, "");
}

// ✅ Handle new note submission
if(isset($_POST['add'])){
    $note = trim($_POST['note']);
    if($note !== ""){
        file_put_contents($filename, $note . "\n", FILE_APPEND);
    }
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// ✅ Handle deleting a note
if(isset($_GET['delete'])){
    $index = $_GET['delete'];
    $notes = file($filename, FILE_IGNORE_NEW_LINES);
    if(isset($notes[$index])){
        unset($notes[$index]);
        file_put_contents($filename, implode("\n", $notes));
    }
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// ✅ Handle editing a note
if(isset($_POST['edit'])){
    $index = $_POST['index'];
    $new_note = trim($_POST['new_note']);
    $notes = file($filename, FILE_IGNORE_NEW_LINES);
    $notes[$index] = $new_note;
    file_put_contents($filename, implode("\n", $notes));
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// ✅ Read all notes
$notes = file($filename, FILE_IGNORE_NEW_LINES);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daily Notes Pro</title>
 <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>📝 Daily Notes Pro</h1>

    <!-- Add New Note -->
    <form method="POST">
        <textarea name="note" placeholder="Write your note here..."></textarea><br>
        <button type="submit" name="add">Add Note</button>
    </form>

    <!-- Show Notes -->
    <?php if(count($notes) > 0): ?>
        <?php foreach($notes as $index => $note): ?>
            <div class="note-box">
                <p><?= htmlspecialchars($note) ?></p>
                <a href="?delete=<?= $index ?>"><button>🗑️ Delete</button></a>
                
                <!-- Edit Form -->
                <form method="POST" class="edit-form">
                    <input type="hidden" name="index" value="<?= $index ?>">
                    <input type="text" name="new_note" value="<?= htmlspecialchars($note) ?>" required>
                    <button type="submit" name="edit">✏️ Edit</button>
                </form>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p style="text-align:center;">No notes yet. Add one!</p>
    <?php endif; ?>
</body>
</html>
