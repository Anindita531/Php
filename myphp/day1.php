<?php
//Variables in PHP
$name = "Anindita";
$age = 21;
$college = "St. Thomas College";

echo "My name is $name. I am $age years old and I study at $college.<br>";
//3. Constants
define("SITE_NAME", "My PHP Learning<br>");
echo SITE_NAME;
//4. Data Types

$num = 10;                // Integer
$price = 199.99;          // Float
$name = "PHP";            // String
$isEasy = true;           // Boolean
$colors = array("Red", "Blue", "Green"); // Array

var_dump($colors);  // Debugging

// Single-line comment

# Another single-line comment

/*
  Multi-line
  comment
*/
#2. Echo vs Print Both are used to display output.

echo "<br>Hello World!<br>";
print "Welcome to PHP!";

#echo → Faster, can output multiple strings.

#print → Slightly slower, returns a value (1).

?>
