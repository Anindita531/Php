
<link rel="stylesheet" href="style.css">

<?php
require_once "db.php";

if ($_SERVER["REQUEST_METHOD"]=="GET") {
    # code...

 
$sqli="SELECT * FROM users ";
$result=mysqli_query($conn,$sqli);
if (mysqli_num_rows($result)>0) {
     echo "<form action='search.php' method='get'>
        <input type='search' name='search' placeholder='Search here...'>
        <input type='submit' value='Search'>
      </form>";
    echo "<table border='2' cellpadding='1' cellspacing='0'>";
    echo "<tr>
         <th>ID</th>
        <th>Name</th>
        <th>Email</th>
           <th>Action </th>
       </tr>";
   
      
echo"<h2>ALL USERS:</h2>";
	while($row=mysqli_fetch_assoc($result))
	{
    $id=$row['id'];    
    $name=$row['name'];
    $email=$row['email'];
 

    echo"<tr>";
    
    echo "<td> $id</td>";
	echo "<td>
    $name</td>";
    echo "<td>
    $email</td>";
    echo "<td><a href='delete.php?id=".$row['id']."' onclick ='return confirm(\"Are you sure to delete ?\")'>Delete</a> | ". " <a href='edit.php?id=".$row['id']."' onclick ='return confirm(\"Are you sure to edit ?\")'>Edit</a></td>";
    echo"</tr>";
	}


}
else{
echo "NO RECORD FOUND  !";
}
}


?>