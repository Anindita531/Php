<!DOCTYPE html>
<html>
<head>
  <title>Mini Daily Expense Estimator 💰</title>
  <link rel="stylesheet" href='./style.css'>
</head>
<body>
  <h1>💸 Mini Daily Expense Estimator</h1>

  <form method="GET">
    <input type="number" name="food" placeholder="Food Expense (₹)" required><br>
    <input type="number" name="transport" placeholder="Transport Expense (₹)" required><br>
    <input type="number" name="entertainment" placeholder="Entertainment Expense (₹)" required><br>
    <button type="submit">Calculate</button>
  </form>

  <?php
  if (isset($_GET['food']) && isset($_GET['transport']) && isset($_GET['entertainment'])) {
    $food = $_GET['food'];
    $transport = $_GET['transport'];
    $entertainment = $_GET['entertainment'];

    $total = $food + $transport + $entertainment;
    $weekly = $total * 7;

    echo "<div class='result'>";
    echo "🧾 Your Total Daily Expense: <b>₹$total</b><br>";
    echo "📅 Estimated Weekly Expense: <b>₹$weekly</b>";
    echo "</div>";
  }
  ?>
</body>
</html>
