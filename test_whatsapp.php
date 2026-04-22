<?php
// Simple test endpoint to exercise WhatsApp sending using current config
require_once __DIR__ . '/includes/notify.php';

// Allow query params or POST
$name = $_REQUEST['name'] ?? 'Test User';
$email = $_REQUEST['email'] ?? 'test@example.com';
$phone = $_REQUEST['phone'] ?? (defined('OWNER_PHONE') ? OWNER_PHONE : '');
$checkin = $_REQUEST['checkin'] ?? date('Y-m-d');
$checkout = $_REQUEST['checkout'] ?? date('Y-m-d', strtotime('+1 day'));
$adults = $_REQUEST['adults'] ?? 1;
$children = $_REQUEST['children'] ?? 0;
$room = $_REQUEST['room'] ?? 'test-room';
$message = $_REQUEST['message'] ?? 'This is a test WhatsApp notification.';

$body = "New booking test\n";
$body .= "Name: {$name}\n";
$body .= "Email: {$email}\n";
$body .= "Phone: {$phone}\n";
$body .= "Check-in: {$checkin}\n";
$body .= "Check-out: {$checkout}\n";
$body .= "Adults: {$adults}\n";
$body .= "Children: {$children}\n";
$body .= "Room: {$room}\n";
$body .= "Message: {$message}\n";

$ok = send_whatsapp_via_twilio($body);

header('Content-Type: application/json');
echo json_encode(['ok' => (bool)$ok, 'log' => 'logs/twilio_whatsapp.log', 'note' => 'Check logs/twilio_whatsapp.log and logs/booking_whatsapp.log (if generated) for details.']);
