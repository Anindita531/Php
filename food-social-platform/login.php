<?php
include 'includes/db.php';
session_start();
if($_SERVER['REQUEST_METHOD']=='POST'){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id,password FROM users WHERE email=?");
    $stmt->bind_param("s",$email);
    $stmt->execute();
    $stmt->bind_result($id,$hashed);
    $stmt->fetch();

    if(password_verify($password,$hashed)){
        $_SESSION['user_id']=$id;
        header("Location: index.php");
    } else { $error="Invalid credentials"; }
}
include 'includes/header.php';
?>

<h1>Login</h1>
<form method="POST">
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <button type="submit">Login</button>
</form>
<?php if(isset($error)) echo "<p>$error</p>"; ?>
<?php include 'includes/footer.php'; ?>
