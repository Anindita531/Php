<?php
session_start();
if(!isset($_SESSION['user'])) exit;

$username = $_SESSION['user'];
$filepath = "users/user_" . preg_replace("/[^a-zA-Z0-9]/", "", $username) . ".html";

$content = $_POST['content'] ?? "";

file_put_contents($filepath, $content);
