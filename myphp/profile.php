<?php
// Variables
$name = "Anindita";
$age = 21;
$college = "St. Thomas' College";
$status = "Student";
$course = "B.Tech (IT)";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profile Table</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        table {
            border-collapse: collapse;
            width: 350px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #007bff;
            color: white;
            text-align: center;
        }
        caption {
            font-size: 18px;
            margin: 10px;
            font-weight: bold;
        }
    </style>
</head>
<body>

<table>
    <caption>Student Profile</caption>
    <tr>
        <th>Field</th>
        <th>Details</th>
    </tr>
    <tr>
        <td>Name</td>
        <td><?php echo $name; ?></td>
    </tr>
    <tr>
        <td>Age</td>
        <td><?php echo $age; ?></td>
    </tr>
    <tr>
        <td>College</td>
        <td><?php echo $college; ?></td>
    </tr>
    <tr>
        <td>Course</td>
        <td><?php echo $course; ?></td>
    </tr>
    <tr>
        <td>Status</td>
        <td><?php echo $status; ?></td>
    </tr>
</table>

</body>
</html>

