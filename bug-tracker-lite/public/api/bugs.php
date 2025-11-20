<?php
require "../../config/db.php";
header("Content-Type: application/json");

$method = $_SERVER['REQUEST_METHOD'];

switch($method){
    case 'GET':
        $res = $conn->query("SELECT * FROM bugs ORDER BY created_at DESC");
        $bugs = [];
        while($r = $res->fetch_assoc()){
            $bugs[] = $r;
        }
        echo json_encode($bugs);
        break;

    case 'POST':
        $data = json_decode(file_get_contents("php://input"), true);
        $title = $data['title'] ?? '';
        $desc = $data['description'] ?? '';
        $priority = $data['priority'] ?? 'Low';
        $stmt = $conn->prepare("INSERT INTO bugs (title, description, priority) VALUES (?,?,?)");
        $stmt->bind_param("sss",$title,$desc,$priority);
        $stmt->execute();
        echo json_encode(["success"=>true,"id"=>$stmt->insert_id]);
        break;

    default:
        http_response_code(405);
        echo json_encode(["message"=>"Method not allowed"]);
}
?>
