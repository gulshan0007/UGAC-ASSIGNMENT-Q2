<?php
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['search_query'])) {
        $searchQuery = $_GET['search_query'];

        $students = array_map('str_getcsv', file('students.csv'));

        $filteredStudents = array_filter($students, function($student) use ($searchQuery) {
            return stripos($student[0], $searchQuery) !== false || stripos($student[1], $searchQuery) !== false;
        });

        echo "<h1>Search Results</h1>";
        echo "<table>";
        echo "<tr>";
        echo "<th>Name</th>";
        echo "<th>Roll Number</th>";
        echo "<th>Department</th>";
        echo "<th>Hostel</th>";
        echo "<th>Actions</th>";
        echo "</tr>";

        foreach ($filteredStudents as $student) {
            echo "<tr>";
            echo "<td>".$student[0]."</td>";
            echo "<td>".$student[1]."</td>";
            echo "<td>".$student[2]."</td>";
            echo "<td>".$student[3]."</td>";
            echo "<td><a href='edit.php?roll_number=".$student[1]."'>Edit</a> | <a href='delete.php?roll_number=".$student[1]."'>Delete</a></td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        header("Location: index.php");
    }
?>
