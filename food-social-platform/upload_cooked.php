<?php
include 'includes/db.php';
include 'includes/header.php';
if(!isset($_SESSION['user_id'])) header("Location: login.php");

$recipe_id = $_GET['recipe_id'];

if($_SERVER['REQUEST_METHOD']=='POST'){
    $image = $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], "assets/images/".$image);
    $stmt=$conn->prepare("INSERT INTO cooked_images (recipe_id,user_id,image) VALUES (?,?,?)");
    $stmt->bind_param("iis",$recipe_id,$_SESSION['user_id'],$image);
    $stmt->execute();
    header("Location:view_recipe.php?id=$recipe_id");
}
?>

<h1>Upload Your Cooked Dish</h1>
<form method="POST" enctype="multipart/form-data">
    <input type="file" name="image" required><br>
    <button type="submit">Upload</button>
</form>

<?php include 'includes/footer.php'; ?>
