<?php
$host = "localhost";
$user = "root";        // change if needed
$pass = "";            // change if needed
$db   = "bug_tracker"; // create this database in phpMyAdmin
$port=3307;          // change if needed
$conn = new mysqli($host, $user, $pass, $db, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
