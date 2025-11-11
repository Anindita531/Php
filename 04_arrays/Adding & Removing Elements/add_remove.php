<?php
$colors = ["Red", "Green"];
echo "<pre>";
echo "Original Array:<br>";
print_r($colors);
// Add elements to end
array_push($colors, "Blue");
echo "After add:";
print_r($colors);

echo "<br>";
// Remove last element
array_pop($colors);
echo "After remove:";
print_r($colors);
echo "<br>";
// Add to beginning
array_unshift($colors, "Yellow");
echo "After add to beginning:";
print_r($colors);

// Remove first element
array_shift($colors);
print_r($colors);

// Remove specific index
unset($colors[0]);
print_r($colors);
?>
