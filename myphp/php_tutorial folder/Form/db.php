<?php
$host="localhost";
$db="day1_db";
$user="root";
$password="YourNewPassword123!";
$conn=mysqli_connect($host,$user,$password,$db);
if (!$conn) {
    # code...
    die("Connection failed ".mysqli_connect_error());
}
?>
