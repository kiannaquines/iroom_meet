<?php
session_start();
include './../conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $student = $_POST['student'];
    $m01 = $_POST['m01'];
    $m02 = $_POST['m02'];
    $m03 = $_POST['m03'];
    $m04 = $_POST['m04'];

    $query = mysqli_query($conn, "INSERT INTO `weekly_performance`(`student`, `m01`, `m02`, `m03`, `m04`) VALUES ('$student','$m01','$m02','$m03','$m04')");
    
    if($query){
        if (isset($_SESSION['role']) && $_SESSION['role'] === 'adviser') {
            header("location: ./../../AdviserWeeklyPerformance.php");
        } else {
            header("location: ./../../ParentWeeklyPerformance.php");
        }
        exit;
    }
}