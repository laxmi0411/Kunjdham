<?php
// Basic configuration - update these values for your environment
define('DB_HOST', 'localhost');
define('DB_NAME', 'kunjdham');
define('DB_USER', 'root');
define('DB_PASS', '');

// Owner contact - used for notifications
define('OWNER_EMAIL', 'lakshmitk2301@gmail.com');
define('OWNER_PHONE', '8317795774');

// Twilio / WhatsApp (optional) - set these if you want automatic WhatsApp notifications
define('TWILIO_SID', '');
define('TWILIO_TOKEN', '');
define('TWILIO_WHATSAPP_FROM', ''); // e.g. 'whatsapp:+1415XXXXXXX'

// Optional SMTP settings (not used by default mail() fallback)
define('SMTP_HOST', '');
define('SMTP_PORT', 587);
define('SMTP_USER', '');
define('SMTP_PASS', '');

// Site base URL (optional)
define('SITE_URL', 'http://localhost/Kunjdham');

?>