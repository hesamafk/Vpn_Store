<?php
declare(strict_types=1);
require_once __DIR__ . '/config.php';

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !csrf_valid()) {
    http_response_code(403);
    $message = 'درخواست نامعتبر است. صفحه را تازه‌سازی کنید و دوباره تلاش کنید.';
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && csrf_valid()) {
    $identity = trim((string)($_POST['username'] ?? ''));
    $password = (string)($_POST['password'] ?? '');

    if ($identity === '' || $password === '') {
        $message = 'نام کاربری و رمز عبور را وارد کنید.';
    } else {
        $stmt = $conn->prepare('SELECT id, username, password FROM login WHERE username = ? OR email = ? LIMIT 1');
        $stmt->bind_param('ss', $identity, $identity);
        $stmt->execute();
        $row = $stmt->get_result()->fetch_assoc();
        $stmt->close();

        if ($row && password_verify($password, (string)$row['password'])) {
            session_regenerate_id(true);
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
            $_SESSION['user_id'] = (int)$row['id'];
            $_SESSION['username'] = (string)$row['username'];
            header('Location: shop.php');
            exit;
        }
        $message = 'اطلاعات ورود صحیح نیست.';
    }
}
?>
<!doctype html>
<html lang="fa" dir="rtl">
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>ورود به حساب | فروشگاه</title><link rel="stylesheet" href="assets/css/bootstrap.min.css"><link rel="stylesheet" href="assets/css/main.css">
<style>body{font-family:Tahoma,sans-serif;background:#f6f7f9}.auth-card{max-width:460px;margin:8vh auto;padding:2rem;background:#fff;border-radius:16px;box-shadow:0 12px 36px #15223812}.auth-card label{display:block;margin:.9rem 0 .4rem}.auth-card input{width:100%;padding:.8rem;border:1px solid #d5dbe4;border-radius:8px}.auth-card button{margin-top:1.2rem;width:100%;padding:.85rem;border:0;border-radius:8px;background:#1d6b54;color:white}.notice{padding:.75rem;border-radius:8px;background:#fff1f0;color:#a32020}</style>
</head><body><main class="auth-card">
<h1>ورود به حساب</h1><p>برای ورود، نام کاربری یا ایمیل خود را وارد کنید.</p>
<?php if ($message !== ''): ?><p class="notice" role="alert"><?= h($message) ?></p><?php endif; ?>
<form method="post" action="login.php" autocomplete="on"><input type="hidden" name="csrf_token" value="<?= h(csrf_token()) ?>">
<label for="username">نام کاربری یا ایمیل</label><input id="username" name="username" autocomplete="username" required maxlength="255">
<label for="password">رمز عبور</label><input id="password" name="password" type="password" autocomplete="current-password" required>
<button type="submit">ورود</button></form><p style="margin-top:1rem">حساب ندارید؟ <a href="register.php">ثبت‌نام کنید</a></p></main></body></html>
