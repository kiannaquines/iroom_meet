<?php
session_start();
include '../conn.php';

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $sql = "DELETE FROM weekly_performance WHERE id='$id'";
  mysqli_query($conn, $sql);

  if (isset($_SESSION['role']) && $_SESSION['role'] === 'adviser') {
    header("location: ./../../AdviserWeeklyPerformance.php");
  } else {
    header("location: ./../../ParentWeeklyPerformance.php");
  }
  exit;
}
