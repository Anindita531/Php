<form method="post" action="">
    Hobbies:<br>
    <input type="checkbox" name="hobbies[]" value="Coding"> Coding<br>
    <input type="checkbox" name="hobbies[]" value="Music"> Music<br>
    <input type="checkbox" name="hobbies[]" value="Reading"> Reading<br>
    <input type="submit" value="Submit">
</form>

<?php
if(isset($_POST['hobbies'])){
    $hobbies = $_POST['hobbies']; // Array of selected values
    echo "Your hobbies: " . implode(", ", $hobbies);
}
?>
