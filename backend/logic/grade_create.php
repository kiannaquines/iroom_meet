<?php
session_start();
include '../conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student = mysqli_real_escape_string($conn, $_POST['student']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $grade = (int)$_POST['grade'];
    $quarter = mysqli_real_escape_string($conn, $_POST['quarter']);

    if (!$student || !$subject || $grade < 0 || $grade > 100 || !$quarter) {
        header('Location: ../../AdviserGrades.php');
        exit;
    }

    $sql = "INSERT INTO grades (student, subject, grade, quarter) VALUES ('$student', '$subject', $grade, '$quarter')";
    if (mysqli_query($conn, $sql)) {
        if (isset($_SESSION['role']) && $_SESSION['role'] === 'adviser') {
            header('Location: ../../AdviserGrades.php');
        } else {
            header('Location: ../../ParentGrades.php');
        }
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>