<?php
// Start session if not started
if(session_status() == PHP_SESSION_NONE){
    session_start();
}

// Include database connection
include 'db.php';
?>
