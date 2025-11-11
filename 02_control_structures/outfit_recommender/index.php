<?php
$weather = "rainy";   // You can change this
$mood = "lazy";        // Or take it from form later

if ($weather == "sunny") {
  if ($mood == "active") {
    $suggestion = "Wear a light t-shirt and sunglasses 😎";
  } else {
    $suggestion = "Cotton wear with a hat 👒";
  }
} elseif ($weather == "rainy") {
  $suggestion = "Take umbrella ☔ and wear a hoodie.";
} elseif ($weather == "cold") {
  $suggestion = "Wear a warm jacket and gloves 🧤.";
} else {
  $suggestion = "Wear something comfortable and stylish!";
}

echo "<h2>Smart Outfit Recommender 👗</h2>";
echo "<p><b>Weather:</b> $weather</p>";
echo "<p><b>Mood:</b> $mood</p>";
echo "<p><b>Suggestion:</b> $suggestion</p>";
?>
