<?php
session_start();
require_once 'config/db.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ===== Trim and sanitize input =====
    $email    = trim($_POST['email']);
    $password = trim($_POST['password']);

    if ($email === '' || $password === '') {
        $error = "Both fields are required!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format!";
    } else {
        // ===== Check if user exists =====
        $stmt = $conn->prepare("SELECT * FROM users WHERE email=? LIMIT 1");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $res = $stmt->get_result();

        if ($res->num_rows > 0) {
            $user = $res->fetch_assoc();

            // ===== Verify password =====
            if (password_verify($password, $user['password'])) {
                // ===== Set session =====
                $_SESSION['user_id']  = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role']     = $user['role'];

                header("Location: index.php");
                exit();
            } else {
                $error = "Incorrect password!";
            }
        } else {
            $error = "No account found with this email!";
        }
    }
}

require_once 'includes/header.php';
?>

<div class="container">
    <h2>Login</h2>

    <?php if($error): ?>
        <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <form method="post" autocomplete="off">
        <label>Email</label>
        <input type="email" name="email" required autocomplete="email">
        <br>
        <label>Password</label>
        <input type="password" name="password" required autocomplete="current-password">
        <br>
        <button type="submit">Login</button>
    </form>

    <p>Don't have an account? <a href="register.php">Register here</a></p>
</div>

<link rel="stylesheet" href="assets/css/style.css">

<?php include 'includes/footer.php'; ?>
