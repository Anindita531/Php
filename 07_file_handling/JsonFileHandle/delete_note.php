<?php
session_start();
if(!isset($_SESSION['user'])) exit;

$username = $_SESSION['user'];
$filepath = "users/user_" . preg_replace("/[^a-zA-Z0-9]/", "", $username) . ".txt";

$id = $_POST['id'];
$notes = file_exists($filepath) ? file($filepath, FILE_IGNORE_NEW_LINES) : [];

if(isset($notes[$id])){
    unset($notes[$id]);
    file_put_contents($filepath, implode("\n", $notes));
}
