<?php
session_start();

// Redirect to dashboard if already logged in
if (isset($_SESSION['username'])) {
    header("Location: dashboard.php");
    exit();
}

$usersFile = "users.json";
$users = json_decode(file_get_contents($usersFile), true);
$message = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $remember = isset($_POST['remember']);

    // Check credentials
    $valid = false;
    foreach ($users as $user) {
        if ($user['username'] === $username && $user['password'] === $password) {
            $valid = true;
            break;
        }
    }

    if ($valid) {
        $_SESSION['username'] = $username;

        // Set cookie if "Remember Me" is checked (expires in 7 days)
        if ($remember) {
            setcookie("username", $username, time() + (7 * 24 * 60 * 60), "/");
        }

        header("Location: dashboard.php");
        exit();
    } else {
        $message = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login System</title>
    <style>
        body { font-family: Arial; background: #f0f0f0; display:flex; justify-content:center; align-items:center; height:100vh; }
        form { background:#fff; padding:20px; border-radius:8px; box-shadow:0 0 10px rgba(0,0,0,0.1);}
        input[type=text], input[type=password] { width:100%; padding:8px; margin:5px 0; }
        input[type=submit] { padding:8px 15px; margin-top:10px; }
        p { color:red; }
    </style>
</head>
<body>
    <form method="post" action="">
        <h2>Login</h2>
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <label><input type="checkbox" name="remember"> Remember Me</label><br>
        <input type="submit" value="Login">
        <?php if($message) echo "<p>$message</p>"; ?>
    </form>
</body>
</html>
