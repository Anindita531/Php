<?php
$numbers = [4, 2, 8, 1];
sort($numbers); // Ascending
echo "<pre>";
print_r($numbers);

rsort($numbers); // Descending
print_r($numbers);
echo "<br>";

$student = ["Ani" => 85, "Riya" => 95];
asort($student); // By value ascending
print_r($student);

arsort($student); // By value descending
print_r($student);

ksort($student); // By key ascending
print_r($student);

krsort($student); // By key descending
print_r($student);
?>
