<?php
include "db.php";
if($_SERVER["REQUEST_METHOD"]=="GET")
{
    $id=$_GET['id'];
    $sql="DELETE FROM USERS WHERE id=$id";//delete query 
    if(mysqli_query($conn,$sql)){

        header("Location:view.php");
        exit();

    }

    else{
        echo"Errors ".mysqli_error($conn);
        }

}
else{

echo"no record found ";

}


?>