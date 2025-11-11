<?php
session_start();

// Destroy session
session_destroy();

echo "Session destroyed. You are logged out.";
?>
