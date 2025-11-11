<?php
// Set the default timezone specifically to Kolkata
date_default_timezone_set('Asia/Kolkata');
 
function showDate() {
    echo "Today's date is: " . date("d M Y H:m:s");
}

showDate();  // calling the function
?>
