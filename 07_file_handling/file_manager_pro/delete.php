<?php
$folder = "uploads/";
$file = basename($_GET['file']);
$path = $folder . $file;

if (file_exists($path)) {
    unlink($path);
    echo "<script>alert('🗑️ File Deleted'); window.location='index.php';</script>";
} else {
    echo "<script>alert('⚠️ File not found!'); window.location='index.php';</script>";
}
?>
