<?php
session_start();
include '../conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id = $_POST['id'];
  $name = $_POST['name'];
  $m01 = $_POST['m01'];
  $m02 = $_POST['m02'];
  $m03 = $_POST['m03'];
  $m04 = $_POST['m04'];

  $sql = "UPDATE weekly_performance SET name='$name', m01='$m01', m02='$m02', m03='$m03', m04='$m04' WHERE id='$id'";
  mysqli_query($conn, $sql);

  if (isset($_SESSION['role']) && $_SESSION['role'] === 'adviser') {
    header("location: ./../../AdviserWeeklyPerformance.php");
  } else {
    header("location: ./../../ParentWeeklyPerformance.php");
  }
  exit;
}
?>
