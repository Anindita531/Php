<?php
$a1 = ["Red", "Green"];
$a2 = ["Blue", "Yellow"];
echo "<pre>";
$merged = array_merge($a1, $a2);
print_r($merged);

$keys = ["name", "age"];
$values = ["Ani", 21];
print_r(array_combine($keys, $values));

$nums = [10, 20, 30, 40, 50];
print_r(array_slice($nums, 1, 3)); // [20,30,40]

array_splice($nums, 2, 2, [99, 100]);
print_r($nums);

print_r(array_chunk($nums, 2));
print_r(array_unique([1,2,2,3,3,4]));
?>
