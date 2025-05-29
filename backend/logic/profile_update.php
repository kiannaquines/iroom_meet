<?php
session_start();
include './../conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if ($_SESSION['role'] !== 'adviser') {
         $id = $_POST['id'];
        $name = $_POST['name'];
        $school_id = $_POST['school_id'];
        $section = $_POST['section'];
        $email = $_POST['email'];
        $contact_no = $_POST['contact_no'];

        $id = mysqli_real_escape_string($conn, $id);
        $name = mysqli_real_escape_string($conn, $name);
        $school_id = mysqli_real_escape_string($conn, $school_id);
        $section = mysqli_real_escape_string($conn, $section);
        $email = mysqli_real_escape_string($conn, $email);
        $contact_no = mysqli_real_escape_string($conn, $contact_no);

        if (mysqli_query($conn, "UPDATE adviser 
            SET name = '$name',
                school_id = '$school_id',
                section = '$section',
                email = '$email',
                contact_no = '$contact_no'
            WHERE id = '$id'")) {
            $_SESSION['username'] = $name;
            header("Location: ./../../AdviserDashboard.php?update=success");
            exit();
        } else {
            echo "Error updating profile: " . mysqli_error($conn);
        }
    } else if($_SESSION['role'] == "parent") {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $school_id = $_POST['school_id'];
        $section = $_POST['section'];
        $email = $_POST['email'];
        $contact_no = $_POST['contact_no'];

        $id = mysqli_real_escape_string($conn, $id);
        $name = mysqli_real_escape_string($conn, $name);
        $school_id = mysqli_real_escape_string($conn, $school_id);
        $section = mysqli_real_escape_string($conn, $section);
        $email = mysqli_real_escape_string($conn, $email);
        $contact_no = mysqli_real_escape_string($conn, $contact_no);

        if (mysqli_query($conn, "UPDATE parent 
            SET name = '$name',
                school_id = '$school_id',
                section = '$section',
                email = '$email',
                contact_no = '$contact_no'
            WHERE id = '$id'")) {
            $_SESSION['username'] = $name;
            header("Location: ./../../ParentDashboard.php?update=success");
            exit();
        } else {
            echo "Error updating profile: " . mysqli_error($conn);
        }
    } else {
        echo "Unauthorized access.";

    }
}