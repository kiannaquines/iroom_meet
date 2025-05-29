<?php
include '../conn.php';

$id = $_POST['id'];
$firstname = $_POST['firstname'];
$middlename = $_POST['middlename'];
$lastname = $_POST['lastname'];
$lrn = $_POST['lrn'];

$query = "UPDATE student SET firstname='$firstname', middlename='$middlename', lastname='$lastname', lrn='$lrn' WHERE id='$id'";
mysqli_query($conn, $query);
if ($_SESSION['role'] === 'parent') {
    header("Location: ../../ParentEnrollees.php");
} else {
    header("Location: ../../AdviserEnrollees.php");

}
exit();