<?php
session_start();
if(!isset($_SESSION['logged_in'])) exit;

$currentUser = $_SESSION['username'] ?? 'guest';
$role = $_SESSION['role'] ?? 'user';
$data = json_decode(file_get_contents('php://input'), true);
$events = json_decode(file_get_contents("events.json"), true) ?: [];

foreach($events as &$event){
    if($event['id'] === $data['id']){
        $user = $event['user'] ?? 'guest';
        if($user === $currentUser || $role === 'admin'){
            $event['title'] = $data['title'];
            $event['date'] = $data['date'];
            $event['location'] = $data['location'];
            $event['description'] = $data['description'];
            file_put_contents("events.json", json_encode($events, JSON_PRETTY_PRINT));
            echo json_encode(['status'=>'success']);
            exit;
        }else{
            echo json_encode(['status'=>'error','message'=>'Permission denied']);
            exit;
        }
    }
}
echo json_encode(['status'=>'error','message'=>'Event not found']);
