<?php
$url = "http://localhost:8080/php_journey/10_api_json/JSON%20Data%20via%20POST%20Request/server.php";

$data = ["name" => "Ani", "role" => "Developer"];

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
