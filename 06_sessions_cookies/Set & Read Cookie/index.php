<?php
// Set a cookie (expires in 1 day)
setcookie("username", "Anindita", time() + 86400, "/");

// Check if cookie exists
if(isset($_COOKIE['username'])) {
    echo "Welcome back, " . $_COOKIE['username'] . "!";
} else {
    echo "Hello, new visitor!";
}
?>
