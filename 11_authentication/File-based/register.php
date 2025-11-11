<?php
session_start();

$usersFile = "users.json"; // file to store user data
if(!file_exists($usersFile)) {
    file_put_contents($usersFile, "[]"); // create file if not exists
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = $_POST["password"];
    $confirm = $_POST["confirm"];

    if($password !== $confirm) {
        $message = "❌ Passwords do not match!";
    } else {
        $users = json_decode(file_get_contents($usersFile), true);

        // Check if user already exists
        $exists = false;
        foreach($users as $user) {
            if($user["email"] === $email) {
                $exists = true;
                break;
            }
        }

        if($exists) {
            $message = "⚠️ User already registered!";
        } else {
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $users[] = ["email" => $email, "password" => $hashed];

            file_put_contents($usersFile, json_encode($users, JSON_PRETTY_PRINT));
            $message = "✅ Registered Successfully! You can now <a href='login.php'>login</a>.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Register - Notion Lite Auth</title>
  <style>
    body { font-family: Poppins, sans-serif; background: #f6f7fb; display: flex; justify-content: center; align-items: center; height: 100vh; }
    form { background: white; padding: 30px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); width: 300px; }
    input, button { width: 100%; padding: 10px; margin: 8px 0; border: 1px solid #ccc; border-radius: 5px; }
    button { background: #4CAF50; color: white; font-weight: bold; cursor: pointer; border: none; }
    button:hover { background: #43A047; }
    h2 { text-align: center; margin-bottom: 15px; }
    p { text-align: center; }
  </style>
</head>
<body>

<form method="post">
  <h2>📝 Register</h2>
  <input type="email" name="email" placeholder="Enter Email" required>
  <input type="password" name="password" placeholder="Enter Password" required>
  <input type="password" name="confirm" placeholder="Confirm Password" required>
  <button type="submit">Register</button>
  <p><?php echo $message ?? ''; ?></p>
  <p>Already have an account? <a href="login.php">Login</a></p>
</form>

</body>
</html>
