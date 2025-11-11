<?php
function calculateArea($length = 5, $width = 3) {
    return $length * $width;
}

echo "Area: " . calculateArea();        // uses default 5x3
echo "<br>";
echo "Area: " . calculateArea(10, 7);   // uses 10x7
?>
