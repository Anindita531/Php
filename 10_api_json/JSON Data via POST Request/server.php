<?php
header("Content-Type: application/json");

$input = json_decode(file_get_contents("php://input"), true);
echo json_encode(["received" => $input]);
?>
