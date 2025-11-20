<?php
require "../config/db.php";
session_start();

$error = '';
if($_SERVER['REQUEST_METHOD']==='POST'){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = 'user'; // default role

    $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?,?,?,?)");
    $stmt->bind_param("ssss",$name,$email,$password,$role);

    if($stmt->execute()){
        header("Location: login.php");
        exit;
    } else {
        $error = "Email already exists or DB error.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - Bug Tracker Lite</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<h2>Register</h2>
<?php if($error) echo "<p style='color:red;'>$error</p>"; ?>
<form method="POST">
    <input type="text" name="name" placeholder="Name" required><br>
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <button type="submit">Register</button>
</form>
<p><a href="login.php">Login</a></p>
</body>
</html>
