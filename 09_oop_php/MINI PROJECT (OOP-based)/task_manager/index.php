<?php
require_once "classes/TaskManager.php";
$manager = new TaskManager();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['title'])) {
        $manager->addTask($_POST['title']);
    } elseif (isset($_POST['delete'])) {
        $manager->deleteTask($_POST['delete']);
    } elseif (isset($_POST['done'])) {
        $manager->markTaskDone($_POST['done']);
    }
}

$tasks = $manager->getAllTasks();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>🧾 Task Manager OOP</title>
<style>
body {
    font-family: Arial, sans-serif;
    background: #f2f4f7;
    padding: 30px;
}
.task {
    background: white;
    padding: 10px;
    border-radius: 8px;
    margin-bottom: 10px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}
.completed {
    text-decoration: line-through;
    color: gray;
}
button {
    margin-left: 5px;
}
</style>
</head>
<body>

<h1>🧠 Task Manager (OOP Edition)</h1>

<form method="POST">
    <input type="text" name="title" placeholder="Enter new task..." required>
    <button type="submit">Add Task</button>
</form>

<hr>

<?php foreach ($tasks as $task): ?>
<div class="task">
    <span class="<?= $task->getStatus() === 'completed' ? 'completed' : '' ?>">
        <?= htmlspecialchars($task->getTitle()) ?>
    </span>
    <form method="POST" style="display:inline;">
        <button name="done" value="<?= $task->getId() ?>">✅</button>
        <button name="delete" value="<?= $task->getId() ?>">🗑️</button>
    </form>
</div>
<?php endforeach; ?>

</body>
</html>
