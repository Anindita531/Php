<?php
require "../includes/auth.php";
checkAuth();
require "../config/db.php";

if($_SERVER['REQUEST_METHOD']==="POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $password, $role);
    $stmt->execute();

    header("Location: users.php");
    exit;
}
?>
<?php include "../includes/header.php"; ?>

<h2>Create User</h2>
<form method="POST">
    <input type="text" name="name" placeholder="Name" required><br>
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <select name="role">
        <option>User</option>
        <option>Admin</option>
    </select><br>
    <button type="submit">Create</button>
</form>

<?php include "../includes/footer.php"; ?>
