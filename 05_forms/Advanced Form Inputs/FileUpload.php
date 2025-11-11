<form method="post" enctype="multipart/form-data" action="">
    Profile Picture: <input type="file" name="profile_pic" required>
    <input type="submit" value="Upload">
</form>

<?php
if(isset($_FILES['profile_pic'])){
    $file = $_FILES['profile_pic'];
    $folder = "uploads/" . $file['name'];
    if(move_uploaded_file($file['tmp_name'], $folder)){
        echo "File uploaded: " . $file['name'];
    }
}
?>
