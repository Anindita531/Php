<?php
$items = ["pen", "book", "pencil", "eraser"];

// Check if value exists
if (in_array("book", $items)) echo "Book found!<br>";

// Search key of value
echo "Index of pencil: " . array_search("pencil", $items);

// Check if key exists
$person = ["name" => "Ani", "age" => 20];
echo key_exists("age", $person) ? "<br>Key exists" : "<br>Key not found";
?>
