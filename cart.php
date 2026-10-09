<?php
declare(strict_types=1);
require_once __DIR__ . '/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_valid()) {
        http_response_code(403);
        exit('درخواست نامعتبر است. صفحه را تازه‌سازی کنید.');
    }
    $action = (string)($_POST['action'] ?? '');
    $id = filter_var($_POST['product_id'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
    $quantity = filter_var($_POST['quantity'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1, 'max_range' => 99]]);
    if ($action === 'add' && $id && $quantity) {
        $stmt = $conn->prepare('SELECT id FROM products WHERE id = ? LIMIT 1');
        $stmt->bind_param('i', $id); $stmt->execute();
        $exists = $stmt->get_result()->num_rows === 1; $stmt->close();
        if ($exists) {
            $_SESSION['cart'] = is_array($_SESSION['cart'] ?? null) ? $_SESSION['cart'] : [];
            $_SESSION['cart'][$id] = min(99, (int)($_SESSION['cart'][$id] ?? 0) + $quantity);
        }
    } elseif ($action === 'update' && $id && $quantity) {
        if (isset($_SESSION['cart'][$id])) $_SESSION['cart'][$id] = $quantity;
    } elseif ($action === 'remove' && $id) {
        unset($_SESSION['cart'][$id]);
    } elseif ($action === 'clear') {
        unset($_SESSION['cart']);
    }
    header('Location: cart.php', true, 303); exit;
}
$cart = $_SESSION['cart'] ?? [];
if (!is_array($cart)) $cart = [];
$items = []; $total = 0.0;
if ($cart) {
    $stmt = $conn->prepare('SELECT id, product_name, category, price FROM products WHERE id = ? LIMIT 1');
    foreach ($cart as $id => $qty) {
        if (!ctype_digit((string)$id) || (int)$id < 1 || !is_numeric($qty) || (int)$qty < 1) continue;
        $pid = (int)$id; $quantity = min(99, (int)$qty);
        $stmt->bind_param('i', $pid); $stmt->execute();
        $product = $stmt->get_result()->fetch_assoc();
        if (!$product) continue;
        $product['quantity'] = $quantity; $product['line_total'] = (float)$product['price'] * $quantity;
        $items[] = $product; $total += $product['line_total'];
    }
    $stmt->close();
}
?>
<!doctype html><html lang="fa" dir="rtl"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>سبد خرید</title>
<style>body{font-family:Tahoma,Arial,sans-serif;background:#f4f7fb;color:#172033;margin:0}main{max-width:900px;margin:2rem auto;padding:1.2rem;background:white;border-radius:14px}table{width:100%;border-collapse:collapse}th,td{text-align:right;padding:.8rem;border-bottom:1px solid #e1e7ef}input{width:65px;padding:.5rem;border:1px solid #ccd5e0;border-radius:6px}button,.button{background:#087f5b;color:#fff;border:0;border-radius:7px;padding:.6rem .8rem;text-decoration:none;cursor:pointer}.remove{background:#a61b1b}.muted{color:#667085}@media(max-width:600px){table{font-size:.82rem}th,td{padding:.45rem}}</style></head><body><main><p><a href="catalog.php">← ادامه خرید</a></p><h1>سبد خرید</h1>
<?php if (!$items): ?><p class="muted">سبد خرید خالی است.</p><a class="button" href="catalog.php">دیدن محصولات</a><?php else: ?>
<div style="overflow-x:auto"><table><thead><tr><th>محصول</th><th>قیمت واحد</th><th>تعداد</th><th>جمع</th><th>عملیات</th></tr></thead><tbody>
<?php foreach ($items as $item): ?><tr><td><?= h($item['product_name']) ?><br><small class="muted"><?= h($item['category']) ?></small></td><td><?= number_format((float)$item['price'],2) ?></td><td><form method="post"><input type="hidden" name="csrf_token" value="<?= h(csrf_token()) ?>"><input type="hidden" name="action" value="update"><input type="hidden" name="product_id" value="<?= (int)$item['id'] ?>"><input type="number" name="quantity" min="1" max="99" value="<?= (int)$item['quantity'] ?>"><button>به‌روزرسانی</button></form></td><td><?= number_format((float)$item['line_total'],2) ?></td><td><form method="post"><input type="hidden" name="csrf_token" value="<?= h(csrf_token()) ?>"><input type="hidden" name="action" value="remove"><input type="hidden" name="product_id" value="<?= (int)$item['id'] ?>"><button class="remove">حذف</button></form></td></tr><?php endforeach; ?>
</tbody></table></div><h2>مجموع: <?= number_format($total,2) ?></h2><p class="muted">این مبلغ دوباره در سمت سرور هنگام تسویه‌حساب محاسبه می‌شود.</p><a class="button" href="checkout.php">ادامه به تسویه‌حساب</a> <form method="post" style="display:inline"><input type="hidden" name="csrf_token" value="<?= h(csrf_token()) ?>"><input type="hidden" name="action" value="clear"><button class="remove">خالی‌کردن سبد</button></form>
<?php endif; ?></main></body></html>
