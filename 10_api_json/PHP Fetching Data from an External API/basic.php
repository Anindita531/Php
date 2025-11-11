<?php
$url = "https://jsonplaceholder.typicode.com/users";
$response = file_get_contents($url);
$data = json_decode($response, true);

foreach ($data as $user) {
  echo $user["name"] . "<br>";
}
?>
