<?php

session_start();

include './../conn.php';

if (!isset($conn)) {
    die("Database connection not found. Check your conn.php file.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' || $_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_POST['action']) && $_POST['action'] === 'create') {
        $name = $_POST['event_name'] ?? '';
        $what = $_POST['event_what'] ?? '';
        $when = $_POST['event_when'] ?? '';
        $where = $_POST['event_where'] ?? '';
        $who = $_POST['event_who'] ?? '';
        $date = date("Y-m-d");

        error_log("Creating event with data: " . print_r($_POST, true));

        $stmt = $conn->prepare("INSERT INTO events (event_name, event_what, event_when, event_where, event_who, event_date) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $name, $what, $when, $where, $who, $date);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Event added!', 'id' => $conn->insert_id]);
        } else {
            error_log("Database error: " . $stmt->error);
            echo json_encode(['success' => false, 'message' => 'Failed to add event: ' . $stmt->error]);
        }
        exit;
    }

    if (isset($_POST['action']) && $_POST['action'] === 'update') {
        $id = $_POST['id'] ?? 0;
        $name = $_POST['event_name'] ?? '';
        $what = $_POST['event_what'] ?? '';
        $when = $_POST['event_when'] ?? '';
        $where = $_POST['event_where'] ?? '';
        $who = $_POST['event_who'] ?? '';
        $date = $_POST['event_date'] ?? date("Y-m-d");

        error_log("Updating event $id with data: " . print_r($_POST, true));

        $stmt = $conn->prepare("UPDATE events SET event_name=?, event_what=?, event_when=?, event_where=?, event_who=?, event_date=? WHERE id=?");
        $stmt->bind_param("ssssssi", $name, $what, $when, $where, $who, $date, $id);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Event updated!']);
        } else {
            error_log("Database error: " . $stmt->error);
            echo json_encode(['success' => false, 'message' => 'Failed to update event: ' . $stmt->error]);
        }
    }

    if (isset($_GET['action']) && $_GET['action'] === 'read') {
        $result = $conn->query("SELECT * FROM events ORDER BY event_date DESC");
        $events = [];

        while ($row = $result->fetch_assoc()) {
            $events[] = $row;
        }

        header('Content-Type: application/json');
        echo json_encode($events);
        exit;
    }

    if (isset($_POST['action']) && $_POST['action'] === 'delete') {
        $id = $_POST['id'];
        $stmt = $conn->prepare("DELETE FROM events WHERE id=?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Event deleted!']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to delete event']);
        }
        exit;
    }
}
