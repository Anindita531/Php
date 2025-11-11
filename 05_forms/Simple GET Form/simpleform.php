<form method="get" action="">
    Name: <input type="text" name="name" required>
    <input type="submit" value="Submit">
</form>

<?php
if(isset($_GET['name'])){
    $name = htmlspecialchars($_GET['name']); // Prevent XSS
    echo "Hello, $name!";
}
?>
