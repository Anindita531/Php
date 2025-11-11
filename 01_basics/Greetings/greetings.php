
<?php
// Set the default timezone specifically to Kolkata
date_default_timezone_set('Asia/Kolkata');
 
// 1. Define the base, universal time (UTC is a good choice)
$utcTime = new DateTime('now', new DateTimeZone('UTC'));

// 2. Create Timezone objects
$kolkataTimezone = new DateTimeZone('Asia/Kolkata');
$londonTimezone = new DateTimeZone('Europe/London');

// 3. Clone the universal time and apply a new timezone to the CLONE
$kolkataTime = clone $utcTime;
$kolkataTime->setTimezone($kolkataTimezone);

$londonTime = clone $utcTime;
$londonTime->setTimezone($londonTimezone);

// Output
echo "Kolkata Time: " . $kolkataTime->format('H:i:s T') . "<br>";
echo "London Time: " . $londonTime->format('H:i:s T') . "<br>";
 
// Print the date and time in a comprehensive format
echo date('l, F d, Y \a\t h:i:s A T');
$hour = date('G'); // 24-hour format of an hour without leading zeros
$name = "Anindita"; // You can change this to any name you want

if ($hour < 12) {
  $greeting = "Good Morning 🌞";
} elseif ($hour < 18) {
  $greeting = "Good Afternoon ☀️";
} elseif ($hour < 21) {
  $greeting = "Good Evening 🌙";
} else {
  $greeting = "Good Night 🌌";
}

echo "<h2>$greeting, $name!</h2>";
echo "<p>It's currently " . date("h:i A") . ".</p>";
?>
