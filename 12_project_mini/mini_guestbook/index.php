<?php
$filename = "guestbook.txt"; // File to store messages

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $message = trim($_POST['message']);

    // Simple validation
    if (!empty($name) && !empty($message)) {
        // Format entry: Name | Message | Timestamp
        $entry = $name . " | " . $message . " | " . date("Y-m-d H:i:s") . "\n";

        // Append to file
        file_put_contents($filename, $entry, FILE_APPEND | LOCK_EX);

        echo "<p style='color:green; text-align:center;'>Thank you for signing the guestbook!</p>";
    } else {
        echo "<p style='color:red; text-align:center;'>Please fill in both fields!</p>";
    }
}

// Read guestbook entries
$entries = [];
if (file_exists($filename)) {
    $entries = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $entries = array_reverse($entries); // Show latest first
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Mini Guestbook</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f9f9f9; margin: 30px; }
        h1 { text-align: center; }
        form { text-align: center; margin-bottom: 30px; }
        input[type=text], textarea { width: 300px; padding: 5px; margin:5px 0; }
        input[type=submit] { padding: 5px 15px; }
        .entry { background: #ffe4b5; padding: 10px; margin: 10px auto; border-radius: 8px; width: 50%; }
    </style>
</head>
<body>
    <h1>📒 Mini Guestbook</h1>

    <!-- Form -->
    <form method="post" action="">
        <input type="text" name="name" placeholder="Your Name" required><br>
        <textarea name="message" placeholder="Your Message" rows="4" required></textarea><br>
        <input type="submit" value="Sign Guestbook">
    </form>

    <!-- Display entries -->
    <?php if(!empty($entries)) { ?>
        <h2 style="text-align:center;">Guestbook Entries</h2>
        <?php foreach($entries as $entry) { 
            list($entry_name, $entry_msg, $entry_time) = explode(" | ", $entry); ?>
            <div class="entry">
                <strong><?php echo htmlspecialchars($entry_name); ?></strong>
                <p><?php echo htmlspecialchars($entry_msg); ?></p>
                <small><?php echo $entry_time; ?></small>
            </div>
        <?php } ?>
    <?php } else { ?>
        <p style="text-align:center;">No entries yet. Be the first to sign! ✍️</p>
    <?php } ?>
</body>
</html>
