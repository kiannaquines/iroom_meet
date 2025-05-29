<?php

if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
    header("Location: ./index.php");
    exit();
} 

if (isset($_SESSION['role']) && $_SESSION['role'] === 'adviser') {
    header("Location: ./AdviserDashboard.php");
} else if (isset($_SESSION['role']) && $_SESSION['role'] === 'parent') {
    header("Location: ./ParentDashboard.php");
}
