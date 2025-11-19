<?php
include 'includes/db.php';
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $stmt = $conn->prepare("INSERT INTO users (name,email,password) VALUES (?,?,?)");
    $stmt->bind_param("sss",$name,$email,$password);
    if($stmt->execute()){
        header("Location: login.php");
    } else { $error = "Email already exists!"; }
}
include 'includes/header.php';
?>

<h1>Register</h1>
<form method="POST">
    <input type="text" name="name" placeholder="Full Name" required><br>
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <button type="submit">Register</button>
</form>
<?php if(isset($error)) echo "<p>$error</p>"; ?>
<?php include 'includes/footer.php'; ?>
