<?php
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/notify.php';
if (session_status() === PHP_SESSION_NONE) session_start();

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$phone_raw = trim($_POST['phone'] ?? '');
$checkin = trim($_POST['checkin'] ?? '');
$checkout = trim($_POST['checkout'] ?? '');
$adults = intval($_POST['adults'] ?? 1);
$children = intval($_POST['children'] ?? 0);
$room = trim($_POST['room'] ?? '');
$message = trim($_POST['message'] ?? '');

$errors = [];
if ($name === '') $errors[] = 'Name is required';
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'A valid email is required';
if ($checkin === '') $errors[] = 'Check-in date is required';
if ($checkout === '') $errors[] = 'Check-out date is required';
if ($room === '') $errors[] = 'Please select a room';

// Phone validation: require and basic digit check
$phone_digits = preg_replace('/\D+/', '', $phone_raw);
if ($phone_digits === '') {
    $errors[] = 'Phone is required';
} elseif (strlen($phone_digits) < 10) {
    $errors[] = 'Phone number must be at least 10 digits';
}

if ($errors) {
    $_SESSION['errors'] = $errors;
    $_SESSION['old'] = $_POST;
    header('Location: booking.php');
    exit;
}

// Normalize dates to YYYY-MM-DD if possible
$checkin_db = date('Y-m-d', strtotime($checkin));
$checkout_db = date('Y-m-d', strtotime($checkout));

$data = [
    'name' => $name,
    'email' => $email,
    'phone' => $phone_raw,
    'checkin' => $checkin_db,
    'checkout' => $checkout_db,
    'adults' => $adults,
    'children' => $children,
    'room' => $room,
    'message' => $message,
];

$id = insert_booking($data);
if (!$id) {
    $_SESSION['errors'] = ['Failed to save booking, please try again later.'];
    $_SESSION['old'] = $_POST;
    header('Location: booking.php');
    exit;
}

$body = "<h3>New booking received</h3>";
$body .= "<ul>";
$body .= "<li><strong>Name:</strong> " . htmlspecialchars($name) . "</li>";
$body .= "<li><strong>Email:</strong> " . htmlspecialchars($email) . "</li>";
$body .= "<li><strong>Phone:</strong> " . htmlspecialchars($phone) . "</li>";
$body .= "<li><strong>Check-in:</strong> " . htmlspecialchars($checkin) . "</li>";
$body .= "<li><strong>Check-out:</strong> " . htmlspecialchars($checkout) . "</li>";
$body .= "<li><strong>Adults:</strong> " . (int)$adults . "</li>";
$body .= "<li><strong>Children:</strong> " . (int)$children . "</li>";
$body .= "<li><strong>Room:</strong> " . htmlspecialchars($room) . "</li>";
$body .= "<li><strong>Message:</strong> " . nl2br(htmlspecialchars($message)) . "</li>";
$body .= "</ul>";
$body .= "<p>Booking ID: {$id}</p>";

// send notifications
send_owner_email("New booking #{$id} from {$name}", $body);

// attempt WhatsApp notification and log result
$wa_ok = send_whatsapp_via_twilio(strip_tags($body));
$logDir = __DIR__ . '/logs';
if (!file_exists($logDir)) @mkdir($logDir, 0755, true);
$logFile = $logDir . '/booking_whatsapp.log';
$entry = date('c') . " | BookingID={$id} | NAME=" . str_replace("\n", ' ', $name) . " | WA_SENT=" . ($wa_ok ? 'YES' : 'NO') . " | TO=" . (defined('OWNER_PHONE') ? OWNER_PHONE : '') . PHP_EOL;
@file_put_contents($logFile, $entry, FILE_APPEND | LOCK_EX);

$_SESSION['success'] = 'Booking submitted successfully. We will contact you soon.';
header('Location: booking.php');
exit;
