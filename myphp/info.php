<?php
$name = "Name: Anindita<br>";
$age = 21;
$college = "College: St. Thomas' College<br>";
$status = "Status: Student<br>";
$course = "Course: B.Tech (IT)<br>";

// Print full info
echo $name . "Age: " . $age . "<br>" . $college . $course . $status;

// Print only name + college
echo "<hr>";
echo $name . $college;
?>
