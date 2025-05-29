<?php
session_start();
include '../conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)$_POST['id'];

    if ($id <= 0) {
        header('Location: ../../AdviserGrade.php');
        exit;
    }

    $sql = "DELETE FROM grades WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        if (isset($_SESSION['role']) && $_SESSION['role'] === 'adviser') {
            header('Location: ../../AdviserGrades.php');
        } else {
            header('Location: ../../ParentGrades.php');
        }
        exit;
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}
?>
