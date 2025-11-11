<?php
session_start();
header('Content-Type: application/json');

$step = $_POST['step'] ?? '';

if($step=='1'){
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    if(empty($name) || empty($email)){
        echo json_encode(['status'=>'error','error'=>'All fields are required.']);
        exit;
    } elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        echo json_encode(['status'=>'error','error'=>'Invalid email.']);
        exit;
    }
    $_SESSION['name']=$name;
    $_SESSION['email']=$email;
    echo json_encode(['status'=>'ok']);
    exit;
}

if($step=='2'){
    $age = trim($_POST['age']);
    $gender = $_POST['gender'] ?? '';
    $hobbies = $_POST['hobbies'] ?? [];
    if(empty($age) || empty($gender)){
        echo json_encode(['status'=>'error','error'=>'Age and Gender required.']);
        exit;
    }
    $_SESSION['age']=$age;
    $_SESSION['gender']=$gender;
    $_SESSION['hobbies']=$hobbies;
    echo json_encode(['status'=>'ok']);
    exit;
}

if($step=='3'){
    if(isset($_FILES['profile_pic'])){
        $file = $_FILES['profile_pic'];
        $filename = time().'_'.$file['name'];
        $target = "uploads/".$filename;
        if(move_uploaded_file($file['tmp_name'], $target)){
            $_SESSION['profile_pic']=$filename;
            echo json_encode(['status'=>'ok','review'=>'<strong>Name:</strong> '.$_SESSION['name'].'<br><strong>Email:</strong> '.$_SESSION['email'].'<br><strong>Age:</strong> '.$_SESSION['age'].'<br><strong>Gender:</strong> '.$_SESSION['gender'].'<br><strong>Hobbies:</strong> '.implode(', ',$_SESSION['hobbies']).'<br><strong>Profile:</strong><br><img src="uploads/'.$filename.'" width="100">']);
            exit;
        } else {
            echo json_encode(['status'=>'error','error'=>'Failed to upload file']);
            exit;
        }
    }
}

if($step=='submit'){
    $dataFile='form.json';
    $submissions=[];
    if(file_exists($dataFile)) $submissions=json_decode(file_get_contents($dataFile),true);
    $submissions[]=[
        "name"=>$_SESSION['name'],
        "email"=>$_SESSION['email'],
        "age"=>$_SESSION['age'],
        "gender"=>$_SESSION['gender'],
        "hobbies"=>$_SESSION['hobbies'],
        "profile_pic"=>$_SESSION['profile_pic'],
        "time"=>date('Y-m-d H:i:s')
    ];
    file_put_contents($dataFile,json_encode($submissions,JSON_PRETTY_PRINT));
    session_destroy();
    echo json_encode(['status'=>'ok']);
}
?>
