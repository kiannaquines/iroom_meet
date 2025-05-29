<?php
session_start();
include './../conn.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (!$conn) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM parent WHERE parent_name = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        echo var_dump($user);
        $_SESSION['id'] = $user['id'];
        $_SESSION['role'] = 'parent';
        header("Location: ./../../ParentDashboard.php");
        exit;
    } else {
        echo "Invalid username or password.";
    }
}
