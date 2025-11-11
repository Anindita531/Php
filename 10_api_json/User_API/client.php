<?php
$url = "http://localhost:8080/php_journey/10_api_json/User_API/api.php";

// Example POST request
$data = ["name" => "Anindita", "email" => "ani@example.com"];

$options = [
  "http" => [
    "header" => "Content-Type: application/json\r\n",
    "method" => "POST",
    "content" => json_encode($data)
  ]
];

$context = stream_context_create($options);
$response = file_get_contents($url, false, $context);

echo $response;
?>
