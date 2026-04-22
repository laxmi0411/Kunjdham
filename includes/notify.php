<?php
require_once __DIR__ . '/../config.php';

function send_owner_email($subject, $body)
{
    $to = OWNER_EMAIL;
    $headers = "From: noreply@" . ($_SERVER['HTTP_HOST'] ?? 'localhost') . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8\r\n";
    return mail($to, $subject, $body, $headers);
}

function send_whatsapp_via_twilio($message)
{
    $missing = [];
    if (empty(TWILIO_SID)) $missing[] = 'TWILIO_SID';
    if (empty(TWILIO_TOKEN)) $missing[] = 'TWILIO_TOKEN';
    if (empty(TWILIO_WHATSAPP_FROM)) $missing[] = 'TWILIO_WHATSAPP_FROM';
    if (empty(OWNER_PHONE)) $missing[] = 'OWNER_PHONE';
    if (!empty($missing)) {
        $logDir = __DIR__ . '/../logs';
        if (!file_exists($logDir)) @mkdir($logDir, 0755, true);
        $logFile = $logDir . '/twilio_whatsapp.log';
        $entry = date('c') . " | MISSING_CONFIG: " . implode(',', $missing) . PHP_EOL;
        @file_put_contents($logFile, $entry, FILE_APPEND | LOCK_EX);
        return false;
    }

    $toPhone = OWNER_PHONE;
    // If user provided a 10-digit local number, assume India +91
    if (preg_match('/^\d{10}$/', $toPhone)) {
        $toPhone = '+91' . $toPhone;
    } elseif (!preg_match('/^\+/', $toPhone)) {
        // Try to sanitize and add + if missing
        $digits = preg_replace('/\D+/', '', $toPhone);
        if ($digits) $toPhone = '+' . $digits;
    }

    $to = 'whatsapp:' . $toPhone;
    $url = "https://api.twilio.com/2010-04-01/Accounts/" . TWILIO_SID . "/Messages.json";
    $data = http_build_query([
        'From' => TWILIO_WHATSAPP_FROM,
        'To' => $to,
        'Body' => $message,
    ]);
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_USERPWD, TWILIO_SID . ':' . TWILIO_TOKEN);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    $http = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $err = curl_error($ch);
    curl_close($ch);

    // Log Twilio response for debugging
    $logDir = __DIR__ . '/../logs';
    if (!file_exists($logDir)) @mkdir($logDir, 0755, true);
    $logFile = $logDir . '/twilio_whatsapp.log';
    $entry = date('c') . " | TO={$to} | HTTP={$http} | ERR={$err} | RESP=" . substr((string)$result, 0, 2000) . PHP_EOL;
    @file_put_contents($logFile, $entry, FILE_APPEND | LOCK_EX);

    return $http >= 200 && $http < 300;
}
