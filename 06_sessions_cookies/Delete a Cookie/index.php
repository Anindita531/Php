<?php
// To delete a cookie, set its expiry in the past
setcookie("username", "", time() - 3600, "/");
echo "Cookie deleted!";
?>
