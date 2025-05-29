<?php
session_start();
include '../conn.php';

if (isset($_POST['id'])) {
  $id = $_POST['id'];
  mysqli_query($conn, "DELETE FROM attendance WHERE id='$id'");

  if ($_SESSION['role'] === 'adviser') {
    header("Location: ./../../AdviserAttendance.php");
  } else {
    header("Location: ./../../ParentAttendance.php");
  }

  exit();
}
