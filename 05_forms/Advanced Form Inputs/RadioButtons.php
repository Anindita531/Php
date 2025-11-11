<form method="post" action="">
    Gender:<br>
    <input type="radio" name="gender" value="Male"> Male<br>
    <input type="radio" name="gender" value="Female"> Female<br>
    <input type="radio" name="gender" value="Other"> Other<br>
    <input type="submit" value="Submit">
</form>

<?php
if(isset($_POST['gender'])){
    echo "Selected gender: " . $_POST['gender'];
}
?>
