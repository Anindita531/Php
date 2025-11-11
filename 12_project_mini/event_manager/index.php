<?php
session_start();
if(!isset($_SESSION['logged_in'])) header("Location: login.php");

$currentUser = $_SESSION['username'] ?? 'guest';
$role = $_SESSION['role'] ?? 'user';
$events = json_decode(file_get_contents("events.json"), true) ?: [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"><link rel="stylesheet" href="style.css">
<title>Eventora :Event Manager</title>

 
</head>
<body>

<h1>📅Eventora :Event Manager</h1>
<button id="themeToggle" class="btn">🌙 Dark Mode</button>
<div class="top-bar">
    <a href="add_event.php" class="btn">➕ Add Event</a>
    <a href="logout.php" class="btn">Logout</a>
</div>

<div class="card-grid">
<?php foreach($events as $event): 
    $eventUser = $event['user'] ?? 'guest';
    $readonly = ($eventUser !== $currentUser && $role !== 'admin') ? 'readonly' : '';
?>
<div class="event-card" data-id="<?= $event['id'] ?>">
    <input type="text" value="<?= htmlspecialchars($event['title']) ?>" <?= $readonly ?>>
    <input type="date" value="<?= $event['date'] ?>" <?= $readonly ?>>
    <input type="text" value="<?= htmlspecialchars($event['location']) ?>" <?= $readonly ?>>
    <textarea <?= $readonly ?>><?= htmlspecialchars($event['description']) ?></textarea>

  <!-- IMAGE -->
<?php if(!empty($event['image'])): 
    $image = trim($event['image']); // remove spaces
    if(filter_var($image, FILTER_VALIDATE_URL) || file_exists($image)):
?>
    <img src="<?= htmlspecialchars($image) ?>" class="event-media">
<?php endif; endif; ?>


    <!-- VIDEO / YouTube -->
    <?php if(!empty($event['video'])):
        $video = $event['video'];
        if(str_contains($video, "youtube.com") || str_contains($video, "youtu.be")) {
            if(str_contains($video, "watch?v=")) $video = str_replace("watch?v=", "embed/", $video);
            if(str_contains($video, "youtu.be/")) $video = str_replace("youtu.be/", "www.youtube.com/embed/", $video);
        }
        if(str_starts_with($video, "http")): ?>
            <iframe src="<?= htmlspecialchars($video) ?>" class="event-media" frameborder="0" allowfullscreen></iframe>
        <?php else: ?>
            <video controls class="event-media">
                <source src="<?= htmlspecialchars($video) ?>" type="video/mp4">
            </video>
        <?php endif; endif; ?>

    <?php if($eventUser === $currentUser || $role === 'admin'): ?>
        <button class="delete-btn">🗑️ Delete</button>
    <?php endif; ?>
</div>
<?php endforeach; ?>
</div>

<script>
// Delete Event
document.querySelectorAll(".delete-btn").forEach(btn => {
    btn.addEventListener("click", () => {
        const card = btn.closest(".event-card");
        const id = parseInt(card.dataset.id);
        fetch("delete_event.php", {
            method: "POST",
            headers: {'Content-Type':'application/json'},
            body: JSON.stringify({id})
        })
        .then(res => res.json())
        .then(data => {
            if(data.status==="success") card.remove();
            else alert(data.message);
        });
    });
});
</script>

</body>
</html>
