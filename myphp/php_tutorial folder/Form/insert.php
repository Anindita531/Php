 <link rel="stylesheet" href="style.css">

<?php
require_once 'db.php';
if ($_SERVER["REQUEST_METHOD"]=="POST") {
    # code...

$name=$_POST['name'];
$email=$_POST['email'];
$password=$_POST['password'];
$sqli="INSERT INTO users (name,email,password) values ('$name','$email','$password')";

if (mysqli_query($conn,$sqli)) {
    # code...
    echo "<p style ='color:green;'>New record created successful !</p>";
   echo "<a href='form.html'>Go back to home</a>";
   echo "<a href='view.php'>View users</a>";
}
else{
echo "Error :".mysqli_error($conn);
}
}

?>