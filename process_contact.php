<?php
/**
 * process_contact.php — handles the Contact form submission
 * Sends a WhatsApp notification (via Twilio) and optionally an email to the owner.
 */
require_once __DIR__ . '/includes/notify.php';
if (session_status() === PHP_SESSION_NONE) session_start();

// Only accept POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: contact.php');
    exit;
}

// ── Collect & sanitise inputs ─────────────────────────────────────────────────
$name    = trim($_POST['name']    ?? '');
$email   = trim($_POST['email']   ?? '');
$phone   = trim($_POST['phone']   ?? '');
$room    = trim($_POST['room']    ?? '');
$subject = trim($_POST['subject'] ?? '');
$message = trim($_POST['message'] ?? '');

// ── Validation ────────────────────────────────────────────────────────────────
$errors = [];
if ($name === '')                                         $errors[] = 'Name is required.';
if (!filter_var($email, FILTER_VALIDATE_EMAIL))           $errors[] = 'A valid email address is required.';
if ($message === '')                                      $errors[] = 'Message cannot be empty.';

// Optional phone validation (only when provided)
if ($phone !== '') {
    $digits = preg_replace('/\D+/', '', $phone);
    if (strlen($digits) < 10) {
        $errors[] = 'Phone number must be at least 10 digits.';
    }
}

if ($errors) {
    $_SESSION['contact_errors'] = $errors;
    $_SESSION['contact_old']    = $_POST;
    header('Location: contact.php');
    exit;
}

// ── Room label map ────────────────────────────────────────────────────────────
$room_labels = [
    'junior'    => 'Junior Suite (₹1111/Night)',
    'executive' => 'Executive Suite (₹2151/Night)',
    'deluxe'    => 'Super Deluxe (₹2151/Night)',
];
$room_label = $room ? ($room_labels[$room] ?? ucfirst($room)) : 'No preference';

// ── Build WhatsApp message ────────────────────────────────────────────────────
$wa_body  = "📩 *New Contact Enquiry — Kunjdham Vrindavan*\n";
$wa_body .= "─────────────────────────\n";
$wa_body .= "👤 *Name:*    {$name}\n";
$wa_body .= "📧 *Email:*   {$email}\n";
$wa_body .= "📞 *Phone:*   " . ($phone ?: '—') . "\n";
$wa_body .= "🛏  *Room Interest:* {$room_label}\n";
$wa_body .= "📌 *Subject:* " . ($subject ?: '—') . "\n";
$wa_body .= "─────────────────────────\n";
$wa_body .= "💬 *Message:*\n{$message}\n";
$wa_body .= "─────────────────────────\n";
$wa_body .= "🕐 " . date('d M Y, h:i A') . " IST";

// ── Build HTML email body ─────────────────────────────────────────────────────
$email_body  = "<h3 style='color:#c8a96e;'>New Contact Enquiry — Kunjdham Vrindavan</h3>";
$email_body .= "<table cellpadding='6' cellspacing='0' style='border-collapse:collapse;font-family:sans-serif;font-size:14px;'>";
$email_body .= "<tr><td><strong>Name</strong></td><td>" . htmlspecialchars($name) . "</td></tr>";
$email_body .= "<tr><td><strong>Email</strong></td><td>" . htmlspecialchars($email) . "</td></tr>";
$email_body .= "<tr><td><strong>Phone</strong></td><td>" . htmlspecialchars($phone ?: '—') . "</td></tr>";
$email_body .= "<tr><td><strong>Room Interest</strong></td><td>" . htmlspecialchars($room_label) . "</td></tr>";
$email_body .= "<tr><td><strong>Subject</strong></td><td>" . htmlspecialchars($subject ?: '—') . "</td></tr>";
$email_body .= "<tr><td><strong>Message</strong></td><td>" . nl2br(htmlspecialchars($message)) . "</td></tr>";
$email_body .= "<tr><td><strong>Date / Time</strong></td><td>" . date('d M Y, h:i A') . " IST</td></tr>";
$email_body .= "</table>";

// ── Send notifications ────────────────────────────────────────────────────────
$mail_subject = "New Contact Enquiry from {$name}" . ($subject ? " — {$subject}" : '');
send_owner_email($mail_subject, $email_body);

$wa_ok = send_whatsapp_via_twilio($wa_body);

// ── Log WhatsApp result ───────────────────────────────────────────────────────
$logDir  = __DIR__ . '/logs';
if (!file_exists($logDir)) @mkdir($logDir, 0755, true);
$logFile = $logDir . '/contact_whatsapp.log';
$entry   = date('c') . " | NAME=" . str_replace("\n", ' ', $name)
         . " | EMAIL=" . $email
         . " | ROOM=" . $room_label
         . " | WA_SENT=" . ($wa_ok ? 'YES' : 'NO')
         . " | TO=" . (defined('OWNER_PHONE') ? OWNER_PHONE : 'N/A')
         . PHP_EOL;
@file_put_contents($logFile, $entry, FILE_APPEND | LOCK_EX);

// ── Redirect with success message ────────────────────────────────────────────
$_SESSION['contact_success'] = 'Thank you, ' . htmlspecialchars($name) . '! Your message has been sent. We will get back to you shortly.';
header('Location: contact.php');
exit;
