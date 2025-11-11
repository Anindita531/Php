 
<?php
session_start();
if(!isset($_SESSION['logged_in'])) exit;

$data = json_decode(file_get_contents('php://input'), true);
$events = json_decode(file_get_contents("events.json"), true);

foreach($events as &$event) {
    if($event['id'] == $data['id']) {
        $event['title'] = $data['title'];
        $event['date'] = $data['date'];
        $event['location'] = $data['location'];
        $event['description'] = $data['description'];
        break;
    }
}



file_put_contents("events.json", json_encode($events, JSON_PRETTY_PRINT));
?>
<link rel="stylesheet" href="style.css">