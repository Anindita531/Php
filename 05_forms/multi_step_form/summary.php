<?php
session_start();
if(!isset($_SESSION['profile_pic'])) header("Location: step3.php");

$dataFile = "form.json";

// Handle final submission
if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST['confirm'])){
    $submissions = [];
    if(file_exists($dataFile)){
        $submissions = json_decode(file_get_contents($dataFile), true);
    }

    $submissions[] = [
        "name" => $_SESSION['name'],
        "email" => $_SESSION['email'],
        "age" => $_SESSION['age'],
        "gender" => $_SESSION['gender'],
        "hobbies" => $_SESSION['hobbies'],
        "profile_pic" => $_SESSION['profile_pic'],
        "time" => date("Y-m-d H:i:s")
    ];

    file_put_contents($dataFile, json_encode($submissions, JSON_PRETTY_PRINT));
    session_destroy();
    echo "<h2>Submission Successful!</h2><a href='step1.php'>Submit Another</a>";
    exit();
}
?>

<h2>Step 4: Review Your Info</h2>
<p><strong>Name:</strong> <?= $_SESSION['name'] ?></p>
<p><strong>Email:</strong> <?= $_SESSION['email'] ?></p>
<p><strong>Age:</strong> <?= $_SESSION['age'] ?></p>
<p><strong>Gender:</strong> <?= $_SESSION['gender'] ?></p>
<p><strong>Hobbies:</strong> <?= implode(", ", $_SESSION['hobbies']) ?></p>
<p><strong>Profile Picture:</strong><br><img src="uploads/<?= $_SESSION['profile_pic'] ?>" width="100"></p>

<form method="post" action="">
    <input type="submit" name="confirm" value="Confirm & Submit">
</form>
