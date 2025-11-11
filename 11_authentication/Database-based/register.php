<?php
$conn = mysqli_connect("localhost", "root", "", "auth_db",3307);

if($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);

  $sql = "INSERT INTO users(name, email, password) VALUES('$name','$email','$pass')";
  mysqli_query($conn, $sql);
  echo "✅ Registered Successfully!";
  header("Location: login.php");
  exit();
}
?>

<form method="post">
  <h2>📝 Register</h2>
  <input type="text" name="name" placeholder="Name" required><br>
  <input type="email" name="email" placeholder="Email" required><br>
  <input type="password" name="password" placeholder="Password" required><br>
  <button type="submit">Register</button>
</form>
