<form method="post" action="">
    Email: <input type="email" name="email" required>
    <input type="submit" value="Submit">
</form>

<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = htmlspecialchars($_POST['email']); // Sanitize input
    echo "Your email is $email";
}
?>
