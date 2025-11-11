<?php
date_default_timezone_set("Asia/Kolkata");

// Step 1: Define playlists
$playlists = [
  "happy" => ["Dance Monkey", "Happy – Pharrell", "Levitating – Dua Lipa"],
  "sad" => ["Fix You – Coldplay", "Someone Like You – Adele", "Let Her Go – Passenger"],
  "calm" => ["Weightless – Marconi Union", "River Flows in You – Yiruma", "Bloom – The Paper Kites"],
  "energetic" => ["Stronger – Kanye West", "Believer – Imagine Dragons", "Don't Stop Me Now – Queen"]
];

// Step 2: Ask for mood (you can replace this with a form later)
$mood = "calm";  // change to happy/sad/energetic to test

// Step 3: Display playlist
if(array_key_exists($mood, $playlists)){
    echo "<h2>Your $mood mood playlist 🎧</h2>";
    foreach($playlists[$mood] as $song){
        echo "🎵 $song<br>";
    }
} else {
    echo "Mood not found!";
}
?>
