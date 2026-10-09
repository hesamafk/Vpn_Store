<?php
declare(strict_types=1);

/**
 * Database configuration.
 * Set SHOP_DB_HOST, SHOP_DB_NAME, SHOP_DB_USER and SHOP_DB_PASSWORD in the server environment.
 * Local XAMPP defaults are intentionally limited to localhost development.
 */
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$host = getenv('SHOP_DB_HOST') ?: '127.0.0.1';
$db   = getenv('SHOP_DB_NAME') ?: 'shop_db';
$user = getenv('SHOP_DB_USER') ?: 'root';
$pass = getenv('SHOP_DB_PASSWORD');
if ($pass === false) {
    $pass = '';
}

try {
    $conn = new mysqli($host, $user, $pass, $db);
    $conn->set_charset('utf8mb4');
} catch (Throwable $e) {
    error_log('Database connection failed: ' . $e->getMessage());
    http_response_code(500);
    exit('اتصال به پایگاه داده برقرار نشد. تنظیمات سرور را بررسی کنید.');
}

if (session_status() !== PHP_SESSION_ACTIVE) {
    ini_set('session.use_strict_mode', '1');
    session_start();
}

function h(mixed $value): string {
    return htmlspecialchars((string)$value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}
