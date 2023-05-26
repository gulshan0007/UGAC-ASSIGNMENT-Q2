<?php
    if (isset($_GET['roll_number'])) {
        $rollNumber = $_GET['roll_number'];

        $students = array_map('str_getcsv', file('students.csv'));

        $student = array_filter($students, function($student) use ($rollNumber) {
            return $student[1] === $rollNumber;
        });

        if (count($student) === 1) {
            $student = current($student);
        } else {
            die("Student not found.");
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST["name"];
        $rollNumber = $_POST["roll_number"];
        $department = $_POST["department"];
        $hostel = $_POST["hostel"];

        $updatedStudents = array_map(function($student) use ($name, $rollNumber, $department, $hostel) {
            if ($student[1] === $rollNumber) {
                return array($name, $rollNumber, $department, $hostel);
            }
            return $student;
        }, $students);

        $file = fopen('students.csv', 'w');
        foreach ($updatedStudents as $student) {
            fputcsv($file, $student);
        }
        fclose($file);

        header("Location: index.php");
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
</head>
<body>
    <h1>Edit Student</h1>
    <form action="" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $student[0]; ?>" required><br><br>
        <label for="roll_number">Roll Number:</label>
        <input type="text" id="roll_number" name="roll_number" value="<?php echo $student[1]; ?>" required readonly><br><br>
        <label for="department">Department:</label>
        <input type="text" id="department" name="department" value="<?php echo $student[2]; ?>" required><br><br>
        <label for="hostel">Hostel:</label>
        <input type="text" id="hostel" name="hostel" value="<?php echo $student[3]; ?>" required><br><br>
        <button type="submit">Update</button>
    </form>
</body>
</html>
