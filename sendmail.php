<?php
declare(strict_types=1);

/**
 * Contact form handler. Configure CONTACT_TO, CONTACT_FROM and SMTP transport
 * before using in production. User-supplied addresses are never used as From.
 */
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    header('Allow: POST');
    exit('Method not allowed');
}
$name = trim((string)($_POST['name'] ?? ''));
$email = trim((string)($_POST['email'] ?? ''));
$phone = trim((string)($_POST['telephone'] ?? ''));
$website = trim((string)($_POST['website'] ?? ''));
$message = trim((string)($_POST['message'] ?? ''));

if ($name === '' || mb_strlen($name) > 120 || !filter_var($email, FILTER_VALIDATE_EMAIL) ||
    mb_strlen($email) > 254 || mb_strlen($phone) > 40 || mb_strlen($website) > 200 ||
    $message === '' || mb_strlen($message) > 5000 ||
    preg_match('/[\r\n]/', $email)) {
    http_response_code(422);
    exit('اطلاعات فرم معتبر نیست. لطفاً ورودی‌ها را بررسی کنید.');
}

$to = getenv('CONTACT_TO') ?: '';
$from = getenv('CONTACT_FROM') ?: '';
if (!filter_var($to, FILTER_VALIDATE_EMAIL) || !filter_var($from, FILTER_VALIDATE_EMAIL)) {
    error_log('Contact form not sent: CONTACT_TO/CONTACT_FROM are not configured.');
    http_response_code(503);
    exit('فرم تماس هنوز پیکربندی نشده است. لطفاً از راه ارتباطی جایگزین استفاده کنید.');
}

// Uses PHP's configured mail transport; no absent PHPMailer dependency.
$subject = 'New website contact';
$body = "Name: {$name}\nEmail: {$email}\nPhone: {$phone}\nWebsite: {$website}\n\n{$message}";
$headers = [
    'From' => $from,
    'Reply-To' => $email,
    'Content-Type' => 'text/plain; charset=UTF-8',
];
if (!function_exists('mail') || !mail($to, $subject, $body, $headers)) {
    error_log('Configured contact mail transport rejected the message.');
    http_response_code(502);
    exit('ارسال پیام انجام نشد. تنظیمات ارسال ایمیل سرور را بررسی کنید.');
}
header('Content-Type: text/html; charset=utf-8');
echo '<!doctype html><html lang="fa" dir="rtl"><meta charset="utf-8"><title>پیام ارسال شد</title><p>پیام شما ارسال شد.</p><a href="catalog.php">بازگشت</a></html>';

