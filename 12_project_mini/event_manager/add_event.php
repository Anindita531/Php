<?php
session_start();
if(!isset($_SESSION['logged_in'])) header("Location: login.php");

$currentUser = $_SESSION['username'] ?? 'guest';
$role = $_SESSION['role'] ?? 'user';

if($_SERVER["REQUEST_METHOD"] === "POST") {
    $events = json_decode(file_get_contents("events.json"), true) ?: [];
    $new_id = count($events) ? end($events)['id'] + 1 : 1;

    if(!is_dir("uploads")) mkdir("uploads", 0755, true);

    // Handle Image
  $imagePath = "";
// If user uploaded file, use it
if(isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
    $imageName = time() . "_" . $_FILES['image']['name'];
    $imagePath = "uploads/" . $imageName;
    move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
}
// If user typed a link, override file
if(!empty($_POST['image_link'])) {
    $imagePath = trim($_POST['image_link']);
}

    // Handle Video
    $videoPath = "";
    if(isset($_FILES['video']) && $_FILES['video']['error'] === 0) {
        $videoName = time() . "_" . basename($_FILES['video']['name']);
        $videoPath = "uploads/" . $videoName;
        move_uploaded_file($_FILES['video']['tmp_name'], $videoPath);
    } elseif(!empty($_POST['video_link']) && filter_var($_POST['video_link'], FILTER_VALIDATE_URL)) {
        $videoPath = $_POST['video_link'];
    }

    $events[] = [
        "id" => $new_id,
        "title" => $_POST['title'],
        "date" => $_POST['date'],
        "location" => $_POST['location'],
        "description" => $_POST['description'],
        "image" => $imagePath,
        "video" => $videoPath,
        "user" => $currentUser
    ];

    file_put_contents("events.json", json_encode($events, JSON_PRETTY_PRINT));
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Add Event</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<h1>Add New Event</h1>
<form method="post" enctype="multipart/form-data">
  <input type="text" name="title" placeholder="Event Title" required><br>
  <input type="date" name="date" required><br>
  <input type="text" name="location" placeholder="Location" required><br>
  <textarea name="description" placeholder="Description" required></textarea><br>

  <label>Upload Image:</label>
  <input type="file" name="image" accept="image/*"><br>
  <label>Or Image URL:</label>
  <input type="text" name="image_link" placeholder="https://example.com/image.jpg"><br>

  <label>Upload Video (MP4):</label>
  <input type="file" name="video" accept="video/mp4"><br>
  <label>Or YouTube Link:</label>
  <input type="text" name="video_link" placeholder="https://youtube.com/..."><br><br>

  <button type="submit">Add Event</button>
</form>
<a href="index.php">Back to Events</a>
</body>
</html>
