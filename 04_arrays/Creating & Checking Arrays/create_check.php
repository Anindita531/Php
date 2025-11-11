<?php
// Create an array
$fruits = array("Apple", "Banana", "Cherry");
print_r($fruits);

// Check if variable is array
echo is_array($fruits) ? "Yes, it's an array" : "No";

// Count elements
echo "<br>Total fruits: " . count($fruits);

// Get keys and values
$student = ["name" => "Anindita", "age" => 21, "dept" => "IT"];
print_r(array_keys($student));
print_r(array_values($student));
?>
