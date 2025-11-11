<?php
session_start(); // Always start session first

// Set session variables
$_SESSION['username'] = "Anindita";
$_SESSION['role'] = "admin";

echo "Session variables are set.<br>";

// Access session variables
echo "Hello, " . $_SESSION['username'] . "! Your role is " . $_SESSION['role'] . ".";
?>
