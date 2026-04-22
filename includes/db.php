<?php
require_once __DIR__ . '/../config.php';

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($mysqli->connect_errno) {
    die('Database connection failed: ' . $mysqli->connect_error);
}

function insert_booking($data)
{
    global $mysqli;
    $stmt = $mysqli->prepare("INSERT INTO bookings (name, email, phone, checkin, checkout, adults, children, room, message, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");
    if (!$stmt) return false;
    $stmt->bind_param('ssssiiiss', $data['name'], $data['email'], $data['phone'], $data['checkin'], $data['checkout'], $data['adults'], $data['children'], $data['room'], $data['message']);
    if ($stmt->execute()) {
        $id = $stmt->insert_id;
        $stmt->close();
        return $id;
    }
    $stmt->close();
    return false;
}
