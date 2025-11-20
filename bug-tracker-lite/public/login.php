<?php
require "../config/db.php";
session_start();

$error = '';

if($_SERVER['REQUEST_METHOD']==='POST'){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, name, password, role FROM users WHERE email=?");
    $stmt->bind_param("s",$email);
    $stmt->execute();
    $stmt->store_result();

    if($stmt->num_rows>0){
        $stmt->bind_result($id, $name, $hash, $role);
        $stmt->fetch();

        if(password_verify($password, $hash)){
            $_SESSION['user_id'] = $id;
            $_SESSION['role'] = $role;
            $_SESSION['name'] = $name;
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "User not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Bug Tracker Lite</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<h2>Login</h2>
<?php if($error) echo "<p style='color:red;'>$error</p>"; ?>
<form method="POST">
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <button type="submit">Login</button>
</form>
<p><a href="register.php">Register</a></p>
</body>
</html>
