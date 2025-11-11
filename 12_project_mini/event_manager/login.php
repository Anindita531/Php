<?php
session_start();
if(!file_exists("users.json")) file_put_contents("users.json", json_encode([]));
$users = json_decode(file_get_contents("users.json"), true);

$message = "";

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    foreach($users as $user){
        if($user['username'] === $username && password_verify($password, $user['password'])){
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $user['role'];
            header("Location: index.php");
            exit;
        }
    }
    $message = "Invalid credentials!";
}
?>
<h1>Login</h1>
<p><?= $message ?></p>
<form method="POST">
    <input type="text" name="username" placeholder="Username" required><br>
    <input type="password" name="password" placeholder="Password" required><br><br>
    <button type="submit">Login</button>
</form>
<p><a href="register.php">Register Here</a></p>
<link rel="stylesheet" href="style.css">
