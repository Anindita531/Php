<?php
session_start();
require_once '../config/db.php';
$error = '';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $stmt = $conn->prepare("SELECT * FROM users WHERE email=? AND role='admin'");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $res = $stmt->get_result();

    if($res->num_rows > 0){
        $user = $res->fetch_assoc();
        if(password_verify($password, $user['password'])){
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username']= $user['username'];
            $_SESSION['role']    = $user['role'];
            header("Location: index.php");
            exit();
        } else {
            $error = "Invalid password!";
        }
    } else {
        $error = "No admin account found with this email!";
    }
}

require_once '../includes/header.php';
?>

<h2>Admin Login</h2>
<?php if($error) echo "<p style='color:red;'>$error</p>"; ?>

<form method="post" action="">
    <label>Email</label>
    <input type="email" name="email" required>
 <br>
    <label>Password</label>
    <input type="password" name="password" required>
<br>
    <button type="submit">Login</button>
</form>

<?php include '../includes/footer.php'; ?>
