<?php
declare(strict_types=1);
require_once __DIR__ . '/config.php';

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim((string)($_POST['username'] ?? ''));
    $email = trim((string)($_POST['email'] ?? ''));
    $password = (string)($_POST['password'] ?? '');
    $confirm = (string)($_POST['confirm_password'] ?? '');

    if ($username === '' || mb_strlen($username) > 255 || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = 'نام کاربری و ایمیل معتبر وارد کنید.';
    } elseif (strlen($password) < 10) {
        $message = 'رمز عبور باید حداقل ۱۰ کاراکتر باشد.';
    } elseif ($password !== $confirm) {
        $message = 'تکرار رمز عبور مطابقت ندارد.';
    } else {
        $check = $conn->prepare('SELECT id FROM login WHERE username = ? OR email = ? LIMIT 1');
        $check->bind_param('ss', $username, $email);
        $check->execute();
        $exists = $check->get_result()->num_rows > 0;
        $check->close();
        if ($exists) {
            $message = 'این نام کاربری یا ایمیل قبلاً ثبت شده است.';
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $insert = $conn->prepare('INSERT INTO login (username, email, password) VALUES (?, ?, ?)');
            $insert->bind_param('sss', $username, $email, $hash);
            $insert->execute();
            $insert->close();
            $message = 'ثبت‌نام انجام شد. اکنون می‌توانید وارد شوید.';
        }
    }
}
?>
<!doctype html>
<html lang="fa" dir="rtl"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>ثبت‌نام | فروشگاه</title><link rel="stylesheet" href="assets/css/bootstrap.min.css"><link rel="stylesheet" href="assets/css/main.css">
<style>body{font-family:Tahoma,sans-serif;background:#f6f7f9}.auth-card{max-width:480px;margin:7vh auto;padding:2rem;background:#fff;border-radius:16px;box-shadow:0 12px 36px #15223812}.auth-card label{display:block;margin:.9rem 0 .4rem}.auth-card input{width:100%;padding:.8rem;border:1px solid #d5dbe4;border-radius:8px}.auth-card button{margin-top:1.2rem;width:100%;padding:.85rem;border:0;border-radius:8px;background:#1d6b54;color:white}.notice{padding:.75rem;border-radius:8px;background:#eef8f1;color:#1b6039}</style></head><body><main class="auth-card">
<h1>ایجاد حساب کاربری</h1><?php if ($message !== ''): ?><p class="notice" role="status"><?= h($message) ?></p><?php endif; ?>
<form method="post" action="register.php">
<label for="username">نام کاربری</label><input id="username" name="username" autocomplete="username" required maxlength="255" value="<?= h($_POST['username'] ?? '') ?>">
<label for="email">ایمیل</label><input id="email" name="email" type="email" autocomplete="email" required maxlength="255" value="<?= h($_POST['email'] ?? '') ?>">
<label for="password">رمز عبور (حداقل ۱۰ کاراکتر)</label><input id="password" name="password" type="password" autocomplete="new-password" required minlength="10">
<label for="confirm_password">تکرار رمز عبور</label><input id="confirm_password" name="confirm_password" type="password" autocomplete="new-password" required minlength="10">
<button type="submit">ثبت‌نام</button></form><p style="margin-top:1rem"><a href="login.php">بازگشت به ورود</a></p></main></body></html>
