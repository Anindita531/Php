<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if ($username && $password) {
        $userFile = "users/$username.json";

        if (file_exists($userFile)) {
            echo "<script>alert('Username already exists!');</script>";
        } else {
            $userData = [
                "username" => $username,
                "password" => password_hash($password, PASSWORD_DEFAULT)
            ];
            file_put_contents($userFile, json_encode($userData));
            mkdir("notes", 0777, true);
            file_put_contents("notes/{$username}_notes.txt", "");
            echo "<script>alert('Signup successful! Please login.'); window.location='index.php';</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles.css">
<title>Sign Up - Notion Lite</title>
</head>
<body>
<h2>Create Your Account</h2>
<form method="POST">
  Username: <input type="text" name="username" required><br><br>
  Password: <input type="password" name="password" required><br><br>
  <input type="submit" value="Sign Up">
</form>
<a href="index.php">Already have an account? Login</a>
</body>
</html>
