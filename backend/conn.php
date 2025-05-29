<?php

$conn = new mysqli("localhost", "root", "", "iroom_meet");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}