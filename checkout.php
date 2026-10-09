<?php
declare(strict_types=1);
require_once __DIR__ . '/config.php';

$message = '';
// Safe default: order submission stays disabled until the owner explicitly opts out of test mode.
$testMode = (getenv('SHOP_TEST_MODE') ?: '1') !== '0';
$cart = $_SESSION['cart'] ?? [];
if (!is_array($cart)) $cart = [];
$cart = array_filter($cart, static fn($qty, $id) => ctype_digit((string)$id) && (int)$id > 0 && is_numeric($qty) && (int)$qty > 0 && (int)$qty <= 99, ARRAY_FILTER_USE_BOTH);

function loadCart(mysqli $conn, array $cart): array {
    $items = []; $subtotal = 0.0;
    if (!$cart) return [$items, $subtotal];
    $stmt = $conn->prepare('SELECT id, product_name, category, price FROM products WHERE id = ? LIMIT 1');
    foreach ($cart as $id => $qty) {
        $pid = (int)$id; $quantity = (int)$qty;
        $stmt->bind_param('i', $pid); $stmt->execute();
        $product = $stmt->get_result()->fetch_assoc();
        if (!$product) continue;
        $product['quantity'] = $quantity;
        $product['line_total'] = (float)$product['price'] * $quantity;
        $subtotal += $product['line_total']; $items[] = $product;
    }
    $stmt->close();
    return [$items, $subtotal];
}
[$items, $subtotal] = loadCart($conn, $cart);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !csrf_valid()) {
    http_response_code(403);
    $message = 'درخواست نامعتبر است. صفحه را تازه‌سازی کنید و دوباره تلاش کنید.';
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && csrf_valid() && $testMode) {
    $message = 'حالت آزمایشی فعال است؛ ثبت سفارش غیرفعال است. برای آزمایش دستی ثبت سفارش، SHOP_TEST_MODE=0 را تنظیم کنید.';
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && csrf_valid() && !$testMode) {
    $email = trim((string)($_POST['email'] ?? ''));
    $first = trim((string)($_POST['fullname-2'] ?? ''));
    $last = trim((string)($_POST['lastname'] ?? ''));
    $company = trim((string)($_POST['company'] ?? ''));
    $country = trim((string)($_POST['country'] ?? ''));
    $street = trim((string)($_POST['street'] ?? ''));
    $street2 = trim((string)($_POST['street-2'] ?? ''));
    $state = trim((string)($_POST['town'] ?? ''));
    $city = trim((string)($_POST['city'] ?? ''));
    $postal = trim((string)($_POST['zip'] ?? ''));
    $phone = trim((string)($_POST['phone'] ?? ''));
    $notes = trim((string)($_POST['message'] ?? ''));

    if (!$items) $message = 'سبد خرید شما خالی است یا محصولات معتبر نیستند.';
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) || $first === '' || $last === '' || $country === '' || $street === '' || $state === '' || $city === '' || $phone === '') $message = 'لطفاً اطلاعات ضروری صورتحساب را کامل و معتبر وارد کنید.';
    else {
        try {
            $conn->begin_transaction();
            $bill = $conn->prepare('INSERT INTO billing_details (email, first_name, last_name, company, country, street_address, street_address_2, state, city, postal_code, phone, order_notes) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
            $bill->bind_param('ssssssssssss', $email, $first, $last, $company, $country, $street, $street2, $state, $city, $postal, $phone, $notes);
            $bill->execute(); $billingId = $conn->insert_id; $bill->close();
            $shipping = 0.0; // Configure a real shipping rule before enabling shipping charges.
            $total = $subtotal + $shipping;
            $method = 'در انتظار انتخاب روش پرداخت';
            $order = $conn->prepare('INSERT INTO orders (user_id, order_total, shipping_cost, payment_method, total_amount, status) VALUES (?, ?, ?, ?, ?, ?)');
            $userId = isset($_SESSION['user_id']) ? (int)$_SESSION['user_id'] : 0; // 0 denotes a guest order in this legacy schema.
            $status = 'در انتظار پرداخت';
            $order->bind_param('iddsds', $userId, $subtotal, $shipping, $method, $total, $status);
            $order->execute(); $orderId = $conn->insert_id; $order->close();
            $line = $conn->prepare('INSERT INTO order_items (order_id, product_name, category, quantity, price) VALUES (?, ?, ?, ?, ?)');
            foreach ($items as $item) {
                $pid = (int)$item['id']; $qty = (int)$item['quantity'];
                // Re-read each price while saving; never accept prices from the browser.
                $name = (string)$item['product_name']; $category = (string)$item['category']; $price = (float)$item['price'];
                $line->bind_param('issid', $orderId, $name, $category, $qty, $price); $line->execute();
            }
            $line->close();
            $conn->commit();
            unset($_SESSION['cart']);
            unset($_SESSION['csrf_token']);
            $message = 'سفارش شماره ' . $orderId . ' ثبت شد؛ پرداخت هنوز انجام نشده است.';
            [$items, $subtotal] = [[], 0.0];
        } catch (Throwable $e) {
            $conn->rollback(); error_log('Checkout failed: ' . $e->getMessage());
            $message = 'ثبت سفارش انجام نشد. لطفاً بعداً دوباره تلاش کنید.';
        }
    }
}
?>
<!doctype html><html lang="fa" dir="rtl"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>تسویه‌حساب</title><link rel="stylesheet" href="assets/css/bootstrap.min.css"><link rel="stylesheet" href="assets/css/main.css"><style>body{font-family:Tahoma,sans-serif;background:#f6f7f9}.checkout{max-width:920px;margin:3rem auto;background:white;padding:2rem;border-radius:16px}.fields{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:1rem}.fields label{display:block}.fields input,.fields textarea{width:100%;padding:.7rem;border:1px solid #d5dbe4;border-radius:7px}.btn{background:#1d6b54;color:white;padding:.8rem 1.2rem}@media(max-width:640px){.fields{grid-template-columns:1fr}}</style></head><body><main class="checkout">
<h1>تسویه‌حساب</h1><?php if($testMode): ?><p role="note" style="background:#fff3cd;color:#664d03;padding:1rem;border-radius:8px">حالت آزمایشی فعال است؛ ثبت سفارش در حال حاضر غیرفعال است و هیچ خریدی انجام نمی‌شود.</p><?php endif; ?><?php if($message!==''): ?><p role="status"><?= h($message) ?></p><?php endif; ?>
<?php if($items): ?><h2>سبد خرید</h2><ul><?php foreach($items as $item): ?><li><?= h($item['product_name']) ?> × <?= (int)$item['quantity'] ?> — <?= number_format((float)$item['line_total'],2) ?></li><?php endforeach; ?></ul><p><strong>جمع کالاها: <?= number_format($subtotal,2) ?></strong></p>
<form method="post" action="checkout.php"><input type="hidden" name="csrf_token" value="<?= h(csrf_token()) ?>"><div class="fields">
<label>ایمیل *<input type="email" name="email" required maxlength="255"></label>
<label>نام *<input name="fullname-2" required maxlength="255"></label><label>نام خانوادگی *<input name="lastname" required maxlength="255"></label>
<label>شرکت<input name="company" maxlength="255"></label><label>کشور *<input name="country" required maxlength="255"></label>
<label>آدرس *<input name="street" required maxlength="255"></label><label>آدرس تکمیلی<input name="street-2" maxlength="255"></label>
<label>استان *<input name="town" required maxlength="255"></label><label>شهر *<input name="city" required maxlength="255"></label>
<label>کد پستی<input name="zip" maxlength="10"></label><label>تلفن *<input name="phone" required maxlength="20"></label>
<label style="grid-column:1/-1">توضیحات<textarea name="message" rows="3" maxlength="2000"></textarea></label>
</div><p>این پروژه در حال حاضر درگاه پرداخت واقعی ندارد؛ ثبت سفارش به معنی پرداخت نیست.</p><button class="btn" type="submit">ثبت سفارش بدون پرداخت</button></form>
<?php else: ?><p>سبد خرید خالی است. برای ثبت سفارش ابتدا محصولی به سبد اضافه کنید.</p><a href="shop.php">بازگشت به فروشگاه</a><?php endif; ?>
</main></body></html>
