<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "test_db";  // change if needed
$port = 3307;         // your XAMPP port

$conn = new mysqli($host, $user, $pass, $dbname, $port);

if ($conn->connect_error) {
  die(json_encode(["error" => "Database connection failed."]));
}
?>
