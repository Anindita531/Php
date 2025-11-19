<?php
include 'includes/db.php';
include 'includes/header.php';

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}

if($_SERVER['REQUEST_METHOD']=='POST'){
    $title = $_POST['title'];
    $ingredients = $_POST['ingredients'];
    $steps = $_POST['steps'];
    $category_id = $_POST['category_id'];
    $cook_time = $_POST['cook_time'];
    $difficulty = $_POST['difficulty'];
    $image = $_FILES['image']['name'];

    if($image) move_uploaded_file($_FILES['image']['tmp_name'], "assets/images/".$image);

    $full_desc = "Ingredients:\n$ingredients\n\nSteps:\n$steps";

    $stmt = $conn->prepare("INSERT INTO recipes (user_id,title,description,category_id,main_image,cook_time,difficulty) VALUES (?,?,?,?,?,?,?)");
    $stmt->bind_param("ississs", $_SESSION['user_id'],$title,$full_desc,$category_id,$image,$cook_time,$difficulty);
    $stmt->execute();

    $recipe_id = $stmt->insert_id;
    header("Location:view_recipe.php?id=$recipe_id");
}

$categories = $conn->query("SELECT * FROM categories");
?>

<h1>Add Recipe</h1>
<form method="POST" enctype="multipart/form-data">
    <input type="text" name="title" placeholder="Recipe Title" required><br>
    <textarea name="ingredients" placeholder="Ingredients (line by line)" required></textarea><br>
    <textarea name="steps" placeholder="Step by Step Instructions" required></textarea><br>
    <select name="category_id" required>
        <option value="">Select Category</option>
        <?php while($cat=$categories->fetch_assoc()): ?>
            <option value="<?= $cat['id'] ?>"><?= $cat['name'] ?></option>
        <?php endwhile; ?>
    </select><br>
    <input type="text" name="cook_time" placeholder="Estimated Cook Time"><br>
    <select name="difficulty" required>
        <option value="">Select Difficulty</option>
        <option value="Easy">Easy</option>
        <option value="Medium">Medium</option>
        <option value="Hard">Hard</option>
    </select><br>
    <input type="file" name="image"><br>
    <button type="submit">Upload Recipe</button>
</form>

<?php include 'includes/footer.php'; ?>
