<?php
session_start();
if(!isset($_SESSION['age'])) header("Location: step2.php");

if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_FILES['profile_pic'])){
    $file = $_FILES['profile_pic'];
    $filename = time()."_".basename($file['name']);
    $target = "uploads/".$filename;

    if(move_uploaded_file($file['tmp_name'], $target)){
        $_SESSION['profile_pic'] = $filename;
        header("Location: review.php");
        exit();
    } else {
        $error = "Failed to upload file!";
    }
}
?>

<h2>Step 3: Upload Profile Picture</h2>
<?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
<form method="post" enctype="multipart/form-data" action="">
    <input type="file" name="profile_pic" required><br>
    <input type="submit" value="Next">
</form>
