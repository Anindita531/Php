<?php
$time = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
echo "<p>Current Time in Kolkata: " . $time->format('H:i:s T') . "</p>";
if ($time->format('H') < 12) {
    echo "<h2>Good Morning! 🌞</h2>";
} elseif ($time->format('H') < 18) {
    echo "<h2>Good Afternoon! ☀️</h2>";
} elseif ($time->format('H') < 21) {
    echo "<h2>Good Evening! 🌙</h2>";
} else {
    echo "<h2>Good Night! 🌌</h2>";
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $task = "Complete the array manipulation task.";
    echo "<h2>Your Task:</h2>";
    echo "<p>$task</p>";
}
?>

<form method="post" action="array_task.php">
    <label for="elements">Enter your task:</label><br>
    <input type="text" id="elements" name="elements" required><br><br>
     
    <input type="submit" value="Submit">
</form>    
