<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);

    if (!empty($username)) {
        $userDir = "users/" . strtolower($username);
        if (!file_exists($userDir)) {
            mkdir($userDir, 0777, true);
        }

        $_SESSION['user'] = $username;
        header("Location: dashboard.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Notion-Lite Login</title>
  <link rel="stylesheet" href="assets/styles.css">
</head>
<body>
  <div class="login-container">
    <h2>📝 Welcome to Notion-Lite</h2>
    <form method="post">
      <input type="text" name="username" placeholder="Enter your username" required>
      <button type="submit">Enter Workspace</button>
    </form>
  </div>
</body>
</html>
