<?php
$num = $_POST['num'];

if($num < 5){
    echo "Too low!";
} elseif($num > 5){
    echo "Too high!";
} else {
    echo "Perfect 5!";
}
?>
