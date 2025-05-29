<?php
session_start();
include './../conn.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $lrn = $_POST['lrn'];
    $section = $_POST['section'];

    if (!$conn) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    $sql = "INSERT INTO `student`(`firstname`, `middlename`, `lastname`, `lrn`, `section`, `type`) VALUES ('$firstname','$middlename','$lastname','$lrn','$section','student')";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    } else {
        if (isset($_SESSION['role']) && $_SESSION['role'] === 'adviser') {
            header("Location: ./../../AdviserEnrollees.php");
        } else {
            header("Location: ./../../ParentEnrollees.php");
        }
        exit;
    }
}
