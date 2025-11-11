<?php
header("Content-Type: application/json");

$data = [
  "status" => "success",
  "message" => "Welcome, Anindita!"
];

echo json_encode($data);
?>
