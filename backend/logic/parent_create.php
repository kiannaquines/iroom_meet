<?php
session_start();
include './../conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $parent_name = $_POST['parent_name'];
    $student = $_POST['student'];
    $student_id = $_POST['student_id'];
    $school_id = $_POST['school_id'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password != $confirm_password) {
        echo "Passwords do not match.";
        exit;
    }

    if (strlen($password) < 8) {
        echo "Password must be at least 8 characters.";
        exit;
    }

    $sql = "INSERT INTO parent (`parent_name`, `student`, `student_id`, `school_id`, `email`, `password`, `type`) 
            VALUES ('$parent_name', '$student', '$student_id', '$school_id', '$email','$password', 'parent')";

    if (mysqli_query($conn, $sql)) {
        header("Location: ./../../LoginParent.php");
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
