<?php
session_start();
include './../conn.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (!$conn) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM adviser WHERE name = '$username' AND password = '$password'";
    $result = mysqli_query($conn, query: $sql);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        echo var_dump($user);
        $_SESSION['username'] = $user['name'];
        $_SESSION['section'] = $user['section'];
        $_SESSION['id'] = $user['id'];
        $_SESSION['school_id'] = $user['school_id'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['contact_no'] = $user['contact_no'];
        $_SESSION['is_loggedin'] = true;
        $_SESSION['role'] = 'adviser';
        header("Location: ./../../AdviserDashboard.php");
        exit;
    } else {
        echo "Invalid username or password.";
    }
}
