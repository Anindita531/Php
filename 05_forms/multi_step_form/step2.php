<?php
session_start();
if(!isset($_SESSION['name'])) header("Location: step1.php"); // Prevent skipping steps

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $_SESSION['age'] = htmlspecialchars(trim($_POST['age']));
    $_SESSION['gender'] = $_POST['gender'];
    $_SESSION['hobbies'] = isset($_POST['hobbies']) ? $_POST['hobbies'] : [];
    header("Location: step3.php");
    exit();
}
?>

<form method="post" action="">
    <h2>Step 2: Additional Info</h2>
    Age: <input type="number" name="age" required><br>
    Gender:<br>
    <input type="radio" name="gender" value="Male" required> Male<br>
    <input type="radio" name="gender" value="Female"> Female<br>
    <input type="radio" name="gender" value="Other"> Other<br>
    Hobbies:<br>
    <input type="checkbox" name="hobbies[]" value="Coding"> Coding<br>
    <input type="checkbox" name="hobbies[]" value="Music"> Music<br>
    <input type="checkbox" name="hobbies[]" value="Reading"> Reading<br>
    <input type="submit" value="Next">
</form>
