<?php
session_start();
require_once 'config/db.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Trim inputs
    $username = trim($_POST['username']);
    $email    = trim($_POST['email']);
    $password = trim($_POST['password']);
    $cpassword= trim($_POST['cpassword']);

    // ===== Validation =====
    if ($username === '' || $email === '' || $password === '' || $cpassword === '') {
        $error = "All fields are required!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format!";
    } elseif (strlen($password) < 6) {
        $error = "Password must be at least 6 characters!";
    } elseif ($password !== $cpassword) {
        $error = "Passwords do not match!";
    } else {
        // ===== Check if email exists =====
        $stmt = $conn->prepare("SELECT id FROM users WHERE email=? LIMIT 1");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $res = $stmt->get_result();

        if ($res->num_rows > 0) {
            $error = "Email already registered!";
        } else {
            // ===== Insert new user =====
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $role = 'user';

            $stmt2 = $conn->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
            $stmt2->bind_param("ssss", $username, $email, $hashed, $role);

            if ($stmt2->execute()) {
                // ===== Auto-login =====
                $_SESSION['user_id'] = $conn->insert_id;
                $_SESSION['username']= $username;
                $_SESSION['role']    = $role;

                header("Location: index.php");
                exit();
            } else {
                $error = "Registration failed! Please try again.";
            }
        }
    }
}

require_once 'includes/header.php';
?>

<div class="container">
    <h2>Register</h2>

    <?php if ($error): ?>
        <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
    <?php elseif ($success): ?>
        <p style="color:green;"><?php echo htmlspecialchars($success); ?></p>
    <?php endif; ?>

    <form method="post" autocomplete="off">
        <label>Username</label>
        <input type="text" name="username" required autocomplete="username">
        <br>
        <label>Email</label>
        <input type="email" name="email" required autocomplete="email">
        <br>
        <label>Password</label>
        <input type="password" name="password" required autocomplete="new-password">
        <br>
        <label>Confirm Password</label>
        <input type="password" name="cpassword" required autocomplete="new-password">
        <br>
        <button type="submit">Register</button>
    </form>

    <p>Already have an account? <a href="login.php">Login here</a></p>
</div>

<link rel="stylesheet" href="assets/css/style.css">

<?php include 'includes/footer.php'; ?>
