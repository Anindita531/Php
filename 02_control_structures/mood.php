<?php
$mood = "happy"; // you can change manually or later take from form

if ($mood == "happy") {
  $quotes = [
    "Happiness is not by chance, but by choice.",
    "Smile more, worry less!"
  ];
} elseif ($mood == "sad") {
  $quotes = [
    "Tough times don’t last, but tough people do.",
    "Every storm runs out of rain."
  ];
} elseif ($mood == "motivated") {
  $quotes = [
    "Push yourself, because no one else is going to do it for you.",
    "Dream big, work hard!"
  ];
} else {
  $quotes = ["Be yourself; everyone else is already taken."];
}

// pick random quote
$random_quote = $quotes[array_rand($quotes)];

echo "<h2>Your Mood: " . strtoupper($mood) . "</h2>";
echo "<p>Quote: $random_quote</p>";
?>
