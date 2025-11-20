<?php
require "../../config/db.php";
header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);
$email = $data['email'] ?? '';
$password = $data['password'] ?? '';

$stmt = $conn->prepare("SELECT id, name, password, role FROM users WHERE email=?");
$stmt->bind_param("s",$email);
$stmt->execute();
$stmt->store_result();

if($stmt->num_rows>0){
    $stmt->bind_result($id,$name,$hash,$role);
    $stmt->fetch();
    if(password_verify($password,$hash)){
        echo json_encode(["success"=>true,"user_id"=>$id,"name"=>$name,"role"=>$role]);
        exit;
    }
}

http_response_code(401);
echo json_encode(["success"=>false,"message"=>"Invalid credentials"]);
?>
