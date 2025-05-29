<?php
session_start();
include '../conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_POST['id'], $_POST['student'], $_POST['subject'], $_POST['grade'], $_POST['quarter'])) {
        $_SESSION['error'] = "All fields are required";
        header('Location: ../../AdviserGrades.php');
        exit();
    }

    $id = intval($_POST['id']);
    $student = intval($_POST['student']);
    $subject = mysqli_real_escape_string($conn, trim($_POST['subject']));
    $grade = intval($_POST['grade']);
    $quarter = mysqli_real_escape_string($conn, trim($_POST['quarter']));

    if ($grade < 0 || $grade > 100) {
        $_SESSION['error'] = "Grade must be between 0 and 100";
        header('Location: ../../AdviserGrades.php');
        exit();
    }

    $validQuarters = ['1st Quarter', '2nd Quarter', '3rd Quarter', '4th Quarter'];
    if (!in_array($quarter, $validQuarters)) {
        $_SESSION['error'] = "Invalid quarter selected";
        header('Location: ../../AdviserGrades.php');
        exit();
    }

    $studentCheck = mysqli_query($conn, "SELECT id FROM student WHERE id = $student");
    if (mysqli_num_rows($studentCheck) == 0) {
        $_SESSION['error'] = "Selected student does not exist";
        header('Location: ../../AdviserGrades.php');
        exit();
    }

    $query = "UPDATE grades SET 
              student = $student, 
              subject = '$subject', 
              grade = $grade, 
              quarter = '$quarter' 
              WHERE id = $id";

    if (mysqli_query($conn, $query)) {
        $_SESSION['success'] = "Grade updated successfully";
    } else {
        $_SESSION['error'] = "Error updating grade: " . mysqli_error($conn);
    }

    header('Location: ../../AdviserGrades.php');
    exit();
} else {
    header('Location: ../../AdviserGrades.php');
    exit();
}
?>