<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>🌤️ Inner Weather App 🌤️</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="card">
  <h1>🌤️ Your Inner Weather 🌤️</h1>

  <form method="get">
    <input type="text" name="city" placeholder="Enter your city" required>
    <br><br>
    <select name="mood">
      <option value="happy">😊 Happy</option>
      <option value="sad">😔 Sad</option>
      <option value="calm">🌿 Calm</option>
      <option value="excited">⚡ Excited</option>
      <option value="tired">😴 Tired</option>
    </select>
    <br><br>
    <button type="submit">Check My Inner Weather</button>
  </form>
<?php
if (isset($_GET['city']) && isset($_GET['mood'])) {
    $city = trim($_GET['city']);
    $mood = $_GET['mood'];

    $apiKey = "4efb9e77dc95d60d5d31682c350e052b"; // Replace with your real key
    $encodedCity = urlencode($city);
    $url = "https://api.openweathermap.org/data/2.5/weather?q={$encodedCity}&appid={$apiKey}&units=metric";

    // Safer request with error handling
    $response = @file_get_contents($url);

    if ($response === false) {
        echo "<p class='error'>⚠️ Unable to connect to weather service. Check your network or API key.</p>";
    } else {
        $data = json_decode($response, true);

        // If JSON decoding failed or city invalid
        if (!is_array($data) || !isset($data['cod'])) {
            echo "<p class='error'>⚠️ Invalid response from weather API.</p>";
        } elseif ((int)$data['cod'] !== 200) {
            $msg = isset($data['message']) ? htmlspecialchars($data['message']) : "City not found.";
            echo "<p class='error'>⚠️ Error: {$msg}</p>";
        } else {
            $temp = $data['main']['temp'] ?? 'N/A';
            $desc = ucfirst($data['weather'][0]['description'] ?? 'N/A');

            echo "<h3>🌍 Real Weather in " . htmlspecialchars($city) . "</h3>";
            echo "<p>{$desc}, {$temp}°C</p>";

            $innerWeather = [
                'happy' => "Inside you, it’s bright and golden — pure sunshine ☀️",
                'sad' => "Inside you, it’s softly raining — growth is coming 🌧️",
                'calm' => "Inside you, it’s peaceful like still water 🌿",
                'excited' => "Inside you, it’s a lightning storm of passion ⚡",
                'tired' => "Inside you, it’s a quiet night with twinkling stars 🌙"
            ];

            echo "<h3>💭 Inner Weather</h3>";
            echo "<p>{$innerWeather[$mood]}</p>";
        }
    }
}
?>
