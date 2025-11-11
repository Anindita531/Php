<?php
session_start();
if(!file_exists("users.json")) file_put_contents("users.json", json_encode([]));
$users = json_decode(file_get_contents("users.json"), true);
$message = "";

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $role = $_POST['role'] ?? 'user';

    // Check if username exists
    foreach($users as $user){
        if($user['username'] === $username){
            $message = "Username already taken!";
            break;
        }
    }

    if(!$message){
        // Hash password before saving
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $users[] = ['username'=>$username,'password'=>$passwordHash,'role'=>$role];
        file_put_contents("users.json", json_encode($users, JSON_PRETTY_PRINT));
        $message = "Registration successful! <a href='login.php'>Login</a>";
    }
}
?>
<h1>Register</h1>
<p><?= $message ?></p>
<form method="POST">
    <input type="text" name="username" placeholder="Username" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <select name="role">
        <option value="user">User</option>
        <option value="admin">Admin</option>
    </select><br><br>
    <button type="submit">Register</button>
    <hr>
    <p>Already have an account? <a href="login.php">Login Here</a></p>
</form>
<link rel="stylesheet" href="style.css">
