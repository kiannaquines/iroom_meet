<?php
session_start();
include '../conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_POST['id'];
  $student = $_POST['student'];
  $status = $_POST['status'];

  mysqli_query($conn, "UPDATE attendance SET student='$student', status='$status' WHERE id=$id");

  if ($_SESSION['role'] === 'parent') {
    header("Location: ../../ParentAttendance.php");
  } else {
    header("Location: ../../AdviserAttendance.php");
  }

  exit();
}
