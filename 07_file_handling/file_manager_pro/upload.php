<?php
header("Content-Type: application/json");
$folder = "uploads/";
if (!is_dir($folder)) mkdir($folder);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (!empty($_FILES['file']['name'])) {
    $target = $folder . basename($_FILES['file']['name']);
    if (move_uploaded_file($_FILES['file']['tmp_name'], $target)) {
      echo json_encode(["status" => "success", "message" => "✅ File uploaded successfully!"]);
    } else {
      echo json_encode(["status" => "error", "message" => "❌ Upload failed."]);
    }
  } else {
    echo json_encode(["status" => "error", "message" => "No file selected."]);
  }
} else {
  echo json_encode(["status" => "error", "message" => "Invalid request."]);
}
?>
