0<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>🌸 Random Compliment Generator 🌸</title>
  <link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

</head>
<body>
  <div class="card">
    <h1>💖 Your Compliment 💖</h1>

    <?php
      $compliments = [
        "You have a beautiful mind, Anindita 💡",
        "Your smile can brighten anyone’s day ☀️",
        "You’re doing amazing things — keep it up! 🌈",
        "You have the courage to turn dreams into reality ✨",
        "You make the world a better place just by being you 💫",
        "Your energy is inspiring — never doubt it! 🔥",
        "You’re learning and growing beautifully 🌷"
      ];

      $random_index = array_rand($compliments);
      $message = $compliments[$random_index];

      echo "<q>$message</q>";
    ?>

    <form method="post">
      <button type="submit"><i class="bi bi-arrow-repeat spinner-border"></i>
New Compliment</button>
    </form>
  </div>
</body>
</html>
