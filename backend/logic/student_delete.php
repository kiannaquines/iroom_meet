<?php
session_start();
include '../conn.php';

$id = $_POST['id'];
$query = "DELETE FROM student WHERE id='$id'";
mysqli_query($conn, $query);

if ($_SESSION['role'] === 'adviser') {
    header("Location: ../../AdviserEnrollees.php");
} else {
    header("Location: ../../ParentEnrollees.php");
}
exit();