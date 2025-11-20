<?php
$host = '127.0.0.1'; // forces TCP/IP
$user = 'root';
$pass = ''; // or your actual password
$db   = 'blog_cms';
$port = 3307;

$conn = new mysqli($host, $user, $pass, $db, $port);

//$pass = ''; // default XAMPP MySQL password is empty MyNewSecure@123

 
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
