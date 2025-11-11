<?php
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST["email"];
  $pass = $_POST["password"];

  $users = json_decode(file_get_contents("users.json"), true);
  $found = false;

  foreach($users as $user) {
    if($user["email"] === $email && password_verify($pass, $user["password"])) {
      $_SESSION["user"] = $email;
      header("Location: dashboard.php");
      exit;
    }
  }

  $error = "❌ Invalid email or password";
}
?>
<link rel="stylesheet" href="assets/styles.css">
<form method="post">
  <h2>🔐 Login</h2>
  <input type="email" name="email" placeholder="Email" required><br>
  <input type="password" name="password" placeholder="Password" required><br>
  <button type="submit">Login</button>
  <p style="color:red;"><?php echo $error ?? ''; ?></p>
</form>
