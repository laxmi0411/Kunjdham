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

// HTML email body
$email_body  = "<h3 style='color:#c8a96e;'>New Booking — Kunjdham Vrindavan</h3>";
$email_body .= "<table cellpadding='6' cellspacing='0' style='border-collapse:collapse;font-family:sans-serif;font-size:14px;'>";
$email_body .= "<tr><td><strong>Booking ID</strong></td><td>#{$id}</td></tr>";
$email_body .= "<tr><td><strong>Name</strong></td><td>" . htmlspecialchars($name) . "</td></tr>";
$email_body .= "<tr><td><strong>Email</strong></td><td>" . htmlspecialchars($email) . "</td></tr>";
$email_body .= "<tr><td><strong>Phone</strong></td><td>" . htmlspecialchars($phone_raw) . "</td></tr>";
$email_body .= "<tr><td><strong>Check-in</strong></td><td>" . htmlspecialchars($checkin) . "</td></tr>";
$email_body .= "<tr><td><strong>Check-out</strong></td><td>" . htmlspecialchars($checkout) . "</td></tr>";
$email_body .= "<tr><td><strong>Adults</strong></td><td>" . (int)$adults . "</td></tr>";
$email_body .= "<tr><td><strong>Children</strong></td><td>" . (int)$children . "</td></tr>";
$email_body .= "<tr><td><strong>Room</strong></td><td>" . htmlspecialchars($room) . "</td></tr>";
$email_body .= "<tr><td><strong>Special Request</strong></td><td>" . nl2br(htmlspecialchars($message)) . "</td></tr>";
$email_body .= "</table>";

// WhatsApp message (formatted with emojis)
$wa_body  = "🏨 *New Room Booking — Kunjdham Vrindavan*\n";
$wa_body .= "─────────────────────────\n";
$wa_body .= "🔖 *Booking ID:* #{$id}\n";
$wa_body .= "👤 *Name:*      {$name}\n";
$wa_body .= "📧 *Email:*     {$email}\n";
$wa_body .= "📞 *Phone:*     {$phone_raw}\n";
$wa_body .= "📅 *Check-in:*  {$checkin}\n";
$wa_body .= "📅 *Check-out:* {$checkout}\n";
$wa_body .= "👨‍👩‍👧 *Adults:*    {$adults}  |  👦 *Children:* {$children}\n";
$wa_body .= "🛏  *Room:*      " . ucfirst($room) . "\n";
if ($message) {
    $wa_body .= "💬 *Request:*   {$message}\n";
}
$wa_body .= "─────────────────────────\n";
$wa_body .= "🕐 " . date('d M Y, h:i A') . " IST";

// Send notifications
send_owner_email("New booking #{$id} from {$name}", $email_body);

// Attempt WhatsApp notification and log result
$wa_ok = send_whatsapp_via_twilio($wa_body);
$logDir = __DIR__ . '/logs';
if (!file_exists($logDir)) @mkdir($logDir, 0755, true);
$logFile = $logDir . '/booking_whatsapp.log';
$entry = date('c') . " | BookingID={$id} | NAME=" . str_replace("\n", ' ', $name) . " | WA_SENT=" . ($wa_ok ? 'YES' : 'NO') . " | TO=" . (defined('OWNER_PHONE') ? OWNER_PHONE : '') . PHP_EOL;
@file_put_contents($logFile, $entry, FILE_APPEND | LOCK_EX);

$_SESSION['success'] = 'Booking submitted successfully. We will contact you soon.';
header('Location: booking.php');
exit;
