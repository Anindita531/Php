<?php
echo "
<style>
table {
    border-collapse: collapse;
    width: 50%;
    margin: 10px;
}
th, td {
    border: 2px solid black;
    padding: 10px;
    text-align: center;
}
th {
    background-color: #4CAF50;
    color: white;
}
</style>
";
//Static Table
echo "<table border='1' cellpadding='10' cellspacing='0'>";
echo "<tr>
        <th>Name</th>
        <th>Age</th>
        <th>Course</th>
      </tr>";
echo "<tr>
        <td>Anindita</td>
        <td>21</td>
        <td>B.Tech (IT)</td>
      </tr>";
echo "<tr>
        <td>Ayaan</td>
        <td>22</td>
        <td>B.Tech (CSE)</td>
      </tr>";
echo "</table>";
//2. Dynamic Table Using PHP Variables
$name = "Anindita";
$age = 21;
$course = "B.Tech (IT)";

echo "<table border='1' cellpadding='10' cellspacing='0'>";
echo "<tr><th>Name</th><th>Age</th><th>Course</th></tr>";
echo "<tr><td>$name</td><td>$age</td><td>$course</td></tr>";
echo "</table>";

//3. Table Using Arrays (Most Used)
$students = [
    ["Anindita", 21, "B.Tech (IT)"],
    ["Ayaan", 22, "B.Tech (CSE)"],
    ["Rahul", 23, "B.Tech (ECE)"]
];

echo "<table border='1' cellpadding='10' cellspacing='0'>";
echo "<tr><th>Name</th><th>Age</th><th>Course</th></tr>";

foreach ($students as $student) {
    echo "<tr>";
    echo "<td>$student[0]</td>";
    echo "<td>$student[1]</td>";
    echo "<td>$student[2]</td>";
    echo "</tr>";
}

echo "</table>";
?>