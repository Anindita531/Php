<?php
// Path to JSON file
$dataFile = "contacts.json";

// Initialize submissions array
$submissions = [];
if(file_exists($dataFile)){
    $submissions = json_decode(file_get_contents($dataFile), true);
}

// Handle form submission
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Sanitize inputs
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));
    $errors = [];

    // Validation
    if(empty($name)) $errors[] = "Name is required.";
    if(empty($email)) $errors[] = "Email is required.";
    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Invalid email.";
    if(empty($message)) $errors[] = "Message is required.";
    elseif(strlen($message) > 250) $errors[] = "Message cannot exceed 250 characters.";

    // File upload handling
    $uploadedFile = "";
    if(isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] == 0){
        $filename = time() . "_" . basename($_FILES['profile_pic']['name']);
        $target = "uploads/" . $filename;
        if(move_uploaded_file($_FILES['profile_pic']['tmp_name'], $target)){
            $uploadedFile = $filename;
        } else {
            $errors[] = "Failed to upload profile picture.";
        }
    }

    // If no errors, save submission
    if(empty($errors)){
        $submissions[] = [
            "name" => $name,
            "email" => $email,
            "message" => $message,
            "profile_pic" => $uploadedFile,
            "time" => date("Y-m-d H:i:s")
        ];
        file_put_contents($dataFile, json_encode($submissions, JSON_PRETTY_PRINT));
        $success = "Your message has been submitted successfully!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Mini Contact Form</title>
    <style>
        body { font-family: Arial; background: #f9f9f9; padding: 20px; }
        form { background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); max-width: 500px; margin:auto; }
        input, textarea { width:100%; padding:8px; margin:5px 0; }
        input[type=submit] { cursor:pointer; background:#007BFF; color:white; border:none; }
        .error { color:red; }
        .success { color:green; }
        .submission { background:#fff; padding:10px; margin-top:10px; border-radius:5px; box-shadow:0 0 5px rgba(0,0,0,0.1); }
        .submission img { max-width:100px; }
    </style>
</head>
<body>

<h2>Mini Contact Form</h2>

<?php
if(!empty($errors)){
    foreach($errors as $err){
        echo "<p class='error'>$err</p>";
    }
}
if(isset($success)){
    echo "<p class='success'>$success</p>";
}
?>

<form method="post" enctype="multipart/form-data" action="">
    <input type="text" name="name" placeholder="Your Name" required>
    <input type="email" name="email" placeholder="Your Email" required>
    <textarea name="message" placeholder="Your Message (max 250 chars)" maxlength="250" required></textarea>
    <input type="file" name="profile_pic" accept="image/*">
    <input type="submit" value="Submit">
</form>

<h3>Previous Submissions:</h3>
<?php
if(!empty($submissions)){
    foreach(array_reverse($submissions) as $sub){
        echo "<div class='submission'>";
        echo "<strong>Name:</strong> " . htmlspecialchars($sub['name']) . "<br>";
        echo "<strong>Email:</strong> " . htmlspecialchars($sub['email']) . "<br>";
        echo "<strong>Message:</strong> " . htmlspecialchars($sub['message']) . "<br>";
        echo "<strong>Time:</strong> " . $sub['time'] . "<br>";
        if(!empty($sub['profile_pic'])){
            echo "<img src='uploads/" . $sub['profile_pic'] . "' alt='Profile Picture'>";
        }
        echo "</div>";
    }
} else {
    echo "<p>No submissions yet.</p>";
}
?>

</body>
</html>
