<?php
// Increase max execution time (temporary)
set_time_limit(300); 

$host = 'localhost';
$db = 'food_social';
$user = 'root';
$pass = '';
$port = 3307; // Make sure MySQL is running on this port

// Create connection
$conn = new mysqli($host, $user, $pass, $db, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Optional: use UTF-8
$conn->set_charset("utf8");
?>
