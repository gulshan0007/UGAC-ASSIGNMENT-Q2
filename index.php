<!DOCTYPE html>
<html>
<head>
    <title>Student Management System</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Student Management System</h1>
    <a href="add.php">Add New Student</a><br><br>
    <form action="search.php" method="get">
        <input type="text" name="search_query" placeholder="Search by name or roll number">
        <button type="submit">Search</button>
    </form>
    <br>
    <table>
        <tr>
            <th>Name</th>
            <th>Roll Number</th>
            <th>Department</th>
            <th>Hostel</th>
            <th>Actions</th>
        </tr>
        <?php
            $students = array_map('str_getcsv', file('students.csv'));
            foreach ($students as $student) {
                echo "<tr>";
                echo "<td>".$student[0]."</td>";
                echo "<td>".$student[1]."</td>";
                echo "<td>".$student[2]."</td>";
                echo "<td>".$student[3]."</td>";
                echo "<td><a href='edit.php?roll_number=".$student[1]."'>Edit</a> | <a href='delete.php?roll_number=".$student[1]."'>Delete</a></td>";
                echo "</tr>";
            }
        ?>
    </table>
</body>
</html>
