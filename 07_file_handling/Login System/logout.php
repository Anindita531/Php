<?php
session_start();

// Destroy session
session_destroy();

// Delete cookie
if(isset($_COOKIE['username'])){
    setcookie("username", "", time() - 3600, "/");
}

header("Location: index.php");
exit();
