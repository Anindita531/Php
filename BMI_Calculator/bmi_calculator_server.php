<?php 
//User inputs weight (kg) and height (m)
$weight=$_POST['weight'];

$height=$_POST['height'];
$bmi = $weight / ($height * $height);
echo "<h2>BMI Calculator</h2>";
echo "Weight: $weight kg<br>";
echo "Height: $height m<br>";
echo "Your BMI is: " . round($bmi, 2) . "<br>"; 

    $bmi = $weight / ($height * $height);
    echo "Your BMI is: " . round($bmi, 2) . "<br>";
    if ($bmi < 18.5) {
    echo "Category: Underweight";
} elseif ($bmi >= 18.5 && $bmi < 24.9) {
    echo "Category: Normal weight";
} elseif ($bmi >= 25 && $bmi < 29.9) {
    echo "Category: Overweight";
} else {
    echo "Category: Obese";
} 
?>
<a href="bmi_calculator.php">Go Back</a>
