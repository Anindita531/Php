<?php
$letters = ["A", "B", "C", "D"];

shuffle($letters);
print_r($letters);

print_r(array_reverse($letters));

$randomKeys = array_rand($letters, 2);
print_r($randomKeys);
?>
