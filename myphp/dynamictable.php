<?php
$students = [
    ["Anindita", 21, "B.Tech (IT)"],
    ["Rahul", 22, "BCA"],
    ["Priya", 20, "MCA"],
    ["Arjun", 23, "B.Sc CS"]
];

echo "<table border='1' cellpadding='10' cellspacing='0'>";
echo "<tr><th>Name</th><th>Age</th><th>Course</th></tr>";

foreach ($students as $student) {
    echo "<tr>";
    echo "<td>".$student[0]."</td>";
    echo "<td>".$student[1]."</td>";
    echo "<td>".$student[2]."</td>";
    echo "</tr>";
}

echo "</table>";
?>
