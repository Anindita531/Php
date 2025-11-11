<?php
$name = "Ani";
$age = 21;
$dept = "IT";

// Create array from variables
print_r(compact("name", "age", "dept"));

// Extract array to variables
$info = ["city" => "Kolkata", "pin" => 700001];
extract($info);
echo "<br>City: $city, Pin: $pin";

$person = ["name" => "A", "age" => 20, "city" => "B"];
echo "<br>First key: " . array_key_first($person);
echo "<br>Last key: " . array_key_last($person);

print_r(range(1, 5));
?>
