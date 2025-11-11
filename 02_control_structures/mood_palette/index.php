<link rel="stylesheet" href="./style.css">
 
<h1>Mood-Based Color Palette</h1>
<?php
// Check if form was submitted
if (isset($_POST['mood'])) {
    $mood = $_POST['mood'];
} else {
    $mood = "calm"; // default mood
}

switch ($mood) {
  case "calm":
    $colors = ["#A8DADC", "#457B9D", "#F1FAEE"];
    break;
  case "energetic":
    $colors = ["#FF6B6B", "#FFD93D", "#6BCB77"];
    break;
  case "romantic":
    $colors = ["#FFC1CC", "#FFB6C1", "#FF69B4"];
    break;
  case "focused":
    $colors = ["#1D3557", "#457B9D", "#A8DADC"];
    break;
  default:
    $colors = ["#E5E5E5", "#CCCCCC", "#999999"];
}

echo "<h2>Your Mood: " . strtoupper($mood) . "</h2>";
echo "<h3>Suggested Colors:</h3>";

foreach ($colors as $color) {
  echo "<div style='background-color:$color; padding:20px; margin:5px; color:white;'>$color</div>";
}
?>

<br><br>

<form method="POST">
  <label>Select your mood: </label>
  <select name="mood">
    <option value="calm">Calm</option>
    <option value="energetic">Energetic</option>
    <option value="romantic">Romantic</option>
    <option value="focused">Focused</option>
  </select>
  <input type="submit" value="Change Mood">
</form>
