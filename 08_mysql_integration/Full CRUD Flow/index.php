<?php
$conn = mysqli_connect("localhost", "root", "", "test_db", 3307);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// ✅ CREATE
$sql_insert = "INSERT INTO users (name, email) VALUES ('Anindita', 'ani@gmail.com')";
if (mysqli_query($conn, $sql_insert)) {
  echo "✅ Inserted successfully. Rows affected: " . mysqli_affected_rows($conn) . "<br>";
} else {
  echo "❌ Insert Error: " . mysqli_error($conn) . "<br>";
}

// ✅ READ
$result = mysqli_query($conn, "SELECT * FROM users");
echo "<h3>📋 User Records:</h3>";
while($row = mysqli_fetch_assoc($result)) {
  echo "ID: {$row['id']} | Name: {$row['name']} | Email: {$row['email']}<br>";
}

// ✅ UPDATE
$sql_update = "UPDATE users SET name='Ani Ghosh' WHERE id=1";
if (mysqli_query($conn, $sql_update)) {
  echo "<br>✏️ Updated successfully. Rows affected: " . mysqli_affected_rows($conn);
} else {
  echo "<br>❌ Update Error: " . mysqli_error($conn);
}

// ✅ DELETE
$sql_delete = "DELETE FROM users WHERE id=2";
if (mysqli_query($conn, $sql_delete)) {
  echo "<br>🗑️ Deleted successfully. Rows affected: " . mysqli_affected_rows($conn);
} else {
  echo "<br>❌ Delete Error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
