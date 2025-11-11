<?php
// Personal variables
$name = "Anindita Ghosh";
$title = "Aspiring Data Scientist";
$college = "St. Thomas College of Engineering and Technology, Kolkata";
$hobby = "Coding,Listening music, Painting, and Exploring New Ideas";
$quote = "Keep Learning, Keep Growing 💡";
$imglink="https://res.cloudinary.com/deowr5s2z/image/upload/v1745140256/wpnggo3ii4tx46arxbqw.jpg";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $name ?> - PHP Profile Card</title>
 <link rel="stylesheet" href="./style.css">
</head>
<body>
  <div class="card">
   
   <div class="circle">
  <?= $imglink ? "<img src='$imglink' width='120' height='120'>" : substr($name, 0, 1) ?>
</div>

    <h2><?= $name ?></h2>
    <p><strong><?= $title ?></strong></p>
    <p><?= $college ?></p>
    <p><strong>Hobby:</strong> <?= $hobby ?></p>
    <p class="quote">“<?= $quote ?>”</p>
    <button onclick="alert('Hi <?= $name ?> 👋 Keep going strong!')">Say Hi</button>
  </div>
</body>
</html>
