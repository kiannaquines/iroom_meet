<?php
session_start();
include '../conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $student = mysqli_real_escape_string($conn, $_POST['student']);
    $m01 = mysqli_real_escape_string($conn, $_POST['m01']);
    $m02 = mysqli_real_escape_string($conn, $_POST['m02']);
    $m03 = mysqli_real_escape_string($conn, $_POST['m03']);
    $m04 = mysqli_real_escape_string($conn, $_POST['m04']);

    $sql = "UPDATE `weekly_performance` SET 
            `student`='$student',
            `m01`='$m01',
            `m02`='$m02',
            `m03`='$m03',
            `m04`='$m04' 
            WHERE `id`='$id'";
    
    $query = mysqli_query($conn, $sql);

    if($query){
        if (isset($_SESSION['role']) && $_SESSION['role'] === 'adviser') {
            header("location: ./../../AdviserWeeklyPerformance.php");
        } else {
            header("location: ./../../ParentWeeklyPerformance.php");
        }
        exit;
    } else {
        die("Update failed: " . mysqli_error($conn));
    }
}