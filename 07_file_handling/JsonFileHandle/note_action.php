<?php
session_start();
$user = strtolower($_SESSION['user']);
$dir = "users/$user";

if (!file_exists($dir)) mkdir($dir, 0777, true);

$action = $_POST['action'] ?? '';

if ($action === 'add') {
    $id = uniqid();
    $note = [
        'id' => $id,
        'title' => $_POST['title'],
        'content' => $_POST['content']
    ];
    file_put_contents("$dir/$id.json", json_encode($note));
    echo json_encode($note);
}

if ($action === 'delete') {
    $id = $_POST['id'];
    unlink("$dir/$id.json");
    echo "deleted";
}

if ($action === 'edit') {
    $id = $_POST['id'];
    $note = [
        'id' => $id,
        'title' => $_POST['title'],
        'content' => $_POST['content']
    ];
    file_put_contents("$dir/$id.json", json_encode($note));
    echo "updated";
}
?>
