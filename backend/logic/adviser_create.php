<?php
session_start();
include './../conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $school_id = $_POST['school_id'];
    $section = $_POST['section'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password != $confirm_password) {
        echo "Passwords do not match.";
        exit;
    }

    if (strlen($password) < 8) {
        echo "Password must be at least 8 characters.";
        exit;
    }

    $sql = "INSERT INTO adviser (name, school_id, section, email, contact_no, password, type) 
            VALUES ('$name', '$school_id', '$section', '$email', '$contact', '$password', 'adviser')";

    if (mysqli_query($conn, $sql)) {
        header("Location: ./../../LoginAdviser.php");
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
