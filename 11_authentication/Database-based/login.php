<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "auth_db",3307);

if($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST['email'];
  $pass = $_POST['password'];

  $result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
  $user = mysqli_fetch_assoc($result);

  if($user && password_verify($pass, $user['password'])) {
    $_SESSION['user'] = $user['name'];
    header("Location: dashboard.php");
    exit;
  } else {
    echo "❌ Invalid login";
  }
}
?>
<form method="post">
  <h2>🔐 Login</h2>
  <input type="email" name="email" placeholder="Email" required><br>
  <input type="password" name="password" placeholder="Password" required><br>
  <button type="submit">Login</button>
</form>
