<?php
header("Content-Type: application/json");
include "db.php";

$method = $_SERVER['REQUEST_METHOD'];

switch($method) {

  // READ all users
  case 'GET':
    $result = $conn->query("SELECT * FROM users");
    $users = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($users);
    break;

  // CREATE new user
  case 'POST':
    $data = json_decode(file_get_contents("php://input"), true);
    $name = $conn->real_escape_string($data['name']);
    $email = $conn->real_escape_string($data['email']);
    $conn->query("INSERT INTO users (name, email) VALUES ('$name', '$email')");
    echo json_encode(["message" => "User created successfully"]);
    break;

  // UPDATE user
  case 'PUT':
    $data = json_decode(file_get_contents("php://input"), true);
    $id = (int)$data['id'];
    $name = $conn->real_escape_string($data['name']);
    $email = $conn->real_escape_string($data['email']);
    $conn->query("UPDATE users SET name='$name', email='$email' WHERE id=$id");
    echo json_encode(["message" => "User updated successfully"]);
    break;

  // DELETE user
  case 'DELETE':
    $data = json_decode(file_get_contents("php://input"), true);
    $id = (int)$data['id'];
    $conn->query("DELETE FROM users WHERE id=$id");
    echo json_encode(["message" => "User deleted successfully"]);
    break;

  default:
    echo json_encode(["error" => "Invalid request method"]);
    break;
}
?>
