<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);

    if(empty($name) || empty($email)){
        echo "All fields are required!";
    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        echo "Invalid email format!";
    } else {
        echo "Hello $name, your email $email is valid!";
    }
}
?><form method="post" action="">
    Email: <input type="email" name="email" required>
  
    Name: <input type="text" name="name" required>
    <input type="submit" value="Submit">
</form>