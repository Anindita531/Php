<?php
require "../includes/auth.php";
checkAuth();
require "../config/db.php";

$id = $_GET['id'] ?? null;
if(!$id){ header("Location: users.php"); exit; }

$stmt = $conn->prepare("SELECT * FROM users WHERE id=?");
$stmt->bind_param("i",$id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if($_SERVER['REQUEST_METHOD']==="POST"){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    $update = $conn->prepare("UPDATE users SET name=?, email=?, role=? WHERE id=?");
    $update->bind_param("sssi",$name,$email,$role,$id);
    $update->execute();

    header("Location: users.php");
    exit;
}
?>
<?php include "../includes/header.php"; ?>

<h2>Edit User</h2>
<form method="POST">
    <input type="text" name="name" value="<?= $user['name'] ?>" required><br>
    <input type="email" name="email" value="<?= $user['email'] ?>" required><br>
    <select name="role">
        <option <?= $user['role']=='user'?'selected':'' ?>>user</option>
        <option <?= $user['role']=='admin'?'selected':'' ?>>admin</option>
    </select><br>
    <button type="submit">Update</button>
</form>

<?php include "../includes/footer.php"; ?>
