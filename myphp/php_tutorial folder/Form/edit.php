<link rel="stylesheet" href="style.css">

<?php
require_once "db.php";
if(isset($_POST['update']))
{
    $id=$_POST['id'];
    $name=$_POST['name'];
    $email=$_POST['email'];
$sqli="UPDATE users SET name='$name',email='$email' where id=$id";
if(mysqli_query($conn,$sqli)){
    
echo"<p style='color:green'>Successfully updated !</p>";
echo"<a href='view.php'>Back</a>";
exit();
}
}


if(isset($_GET['id'])){
    $id=$_GET['id'];
    $sqli="SELECT * FROM USERS Where id=$id";
    $result=mysqli_query($conn,$sqli);
    $row=mysqli_fetch_assoc($result);
}
?>
<!DOCTYPE html>
<html lang='eng'>
  <head>
    <link src="styles.css">
    <meta content="Width =Device-width initial-scale=1.0">
</head>
<body>
    <h2>EDIT FORM</h2>
<form action="" method="post">
<input type='hidden' name='id' value="<?php echo $row['id'];?>">
   <label>Name:</label><br>
<input type='text' name='name' value="<?php echo $row['name'];?>"><br>
   <label>Email:</label><br>
<input type='email' name='email' value="<?php echo $row['email'];?>"><br>
   <label>Password:</label><br>
<input type='password' name='password' value="<?php echo $row['password'];?>"><br>

<input type='submit' name='update' value="update">
</form>

</body>
</html>