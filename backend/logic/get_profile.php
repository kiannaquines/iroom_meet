<?php

if ($_SESSION['role'] == 'adviser') {

    $query = "SELECT * FROM `adviser` WHERE id = '" . $_SESSION['id'] . "'";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }
    $user = mysqli_fetch_assoc($result);
    if (!$user) {
        die("User not found.");
    }

    $id = $user['id'];
    $username = $user['name'];
    $section = $user['section'];
    $school_id = $user['school_id'];
    $email = $user['email'];
    $contact_no = $user['contact_no'];
} else {

    $query = "SELECT * FROM `parent` WHERE id = '" . $_SESSION['id'] . "'";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }
    $user = mysqli_fetch_assoc($result);
    if (!$user) {
        die("User not found.");
    }

    $id = $user['id'];
    $username = $user['parent_name'];
    $student = $user['student'];
    $school_id = $user['school_id'];
    $email = $user['email'];
}
