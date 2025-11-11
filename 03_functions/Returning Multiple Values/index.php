<?php
function getMinMax($numbers) {
    $min = min($numbers);
    $max = max($numbers);
    return [$min, $max];
}

list($lowest, $highest) = getMinMax([5, 2, 9, 1, 6]);
echo "Lowest: $lowest, Highest: $highest";
?>
