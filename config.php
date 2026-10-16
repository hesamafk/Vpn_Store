<?php
declare(strict_types=1);

/**
 * Database configuration.
 * Set SHOP_DB_HOST, SHOP_DB_NAME, SHOP_DB_USER and SHOP_DB_PASSWORD in the server environment.
 * Local XAMPP defaults are intentionally limited to localhost development.
 */
if (!extension_loaded('mysqli') || !extension_loaded('mbstring')) {
    http_response_code(503);
    exit('افزونه‌های mysqli و mbstring باید در PHP فعال باشند.');
}
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
    session_set_cookie_params(['httponly' => true, 'samesite' => 'Lax', 'secure' => !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off']);
    session_start();
}

function h(mixed $value): string {
    return htmlspecialchars((string)$value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function csrf_token(): string {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return (string)$_SESSION['csrf_token'];
}

function csrf_valid(): bool {
    $submitted = (string)($_POST['csrf_token'] ?? '');
    $stored = (string)($_SESSION['csrf_token'] ?? '');
    return $submitted !== '' && $stored !== '' && hash_equals($stored, $submitted);
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && (int)($_SERVER['CONTENT_LENGTH'] ?? 0) > 65536) {
    http_response_code(413);
    exit('حجم درخواست بیش از حد مجاز است.');
}
