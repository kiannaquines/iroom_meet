<?php
session_start();
include './../conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $status = $_POST['status'];

    $sql = "INSERT INTO `attendance`(`name`, `status`) VALUES ('$name','$status')";

    if (mysqli_query($conn, $sql)) {
        if (isset($_SESSION['role']) && $_SESSION['role'] === 'adviser') {
            header("Location: ./../../AdviserAttendance.php");
        } else {
            header("Location: ./../../ParentAttendance.php");
        }
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
