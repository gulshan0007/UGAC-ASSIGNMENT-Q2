<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>
</head>
<body>
    <h1>Add Student</h1>
    <form action="" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>
        <label for="roll_number">Roll Number:</label>
        <input type="text" id="roll_number" name="roll_number" required><br><br>
        <label for="department">Department:</label>
        <input type="text" id="department" name="department" required><br><br>
        <label for="hostel">Hostel:</label>
        <input type="text" id="hostel" name="hostel" required><br><br>
        <button type="submit">Add</button>
    </form>
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST["name"];
            $rollNumber = $_POST["roll_number"];
            $department = $_POST["department"];
            $hostel = $_POST["hostel"];

            $studentData = array($name, $rollNumber, $department, $hostel);
            $file = fopen('students.csv', 'a');
            fputcsv($file, $studentData);
            fclose($file);

            header("Location: index.php");
        }
    ?>
</body>
</html>
