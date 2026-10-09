<?php
declare(strict_types=1);
require_once __DIR__ . '/config.php';

$result = $conn->query('SELECT id, product_name, price, category, image_url, image FROM products ORDER BY id DESC');
$products = $result->fetch_all(MYSQLI_ASSOC);
?>
<!doctype html>
<html lang="fa" dir="rtl">
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="description" content="فهرست بسته‌ها و محصولات فروشگاه">
<title>فهرست محصولات | فروشگاه</title>
<style>
:root{font-family:Tahoma,Arial,sans-serif;color:#172033;background:#f4f7fb}*{box-sizing:border-box}body{margin:0}header{background:#102a43;color:white;padding:1.2rem max(1rem,calc((100% - 1100px)/2));display:flex;align-items:center;justify-content:space-between;gap:1rem;flex-wrap:wrap}header a{color:white}main{max-width:1100px;margin:2rem auto;padding:0 1rem}.grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(230px,1fr));gap:1rem}.card{background:white;border:1px solid #dce4ef;border-radius:14px;padding:1.2rem;box-shadow:0 6px 20px #102a430a}.price{font-size:1.2rem;font-weight:bold;color:#087f5b}.muted{color:#667085}.card button,.button{border:0;border-radius:8px;background:#087f5b;color:white;padding:.7rem 1rem;cursor:pointer;text-decoration:none;display:inline-block}.card input{width:80px;padding:.55rem;border:1px solid #ccd5e0;border-radius:6px}h1{line-height:1.4}
</style>
</head><body>
<header><strong>فروشگاه</strong><nav><a href="catalog.php">محصولات</a>　<a href="cart.php">سبد خرید (<?= array_sum(array_map('intval', is_array($_SESSION['cart'] ?? null) ? $_SESSION['cart'] : [])) ?>)</a>　<a href="login.php">ورود</a></nav></header>
<main><h1>محصولات</h1><p class="muted">قیمت‌ها از پایگاه داده خوانده می‌شوند؛ مبلغ ارسالی مرورگر برای سفارش معتبر نیست.</p>
<?php if (!$products): ?><p>هنوز محصولی ثبت نشده است. ابتدا جدول products را در پایگاه داده تکمیل کنید.</p><?php else: ?>
<div class="grid"><?php foreach ($products as $product): ?><article class="card"><p class="muted"><?= h($product['category']) ?></p><h2><?= h($product['product_name']) ?></h2><p class="price"><?= number_format((float)$product['price'], 2) ?></p><form method="post" action="cart.php"><input type="hidden" name="csrf_token" value="<?= h(csrf_token()) ?>"><input type="hidden" name="action" value="add"><input type="hidden" name="product_id" value="<?= (int)$product['id'] ?>"><label>تعداد <input type="number" name="quantity" min="1" max="99" value="1" required></label> <button type="submit">افزودن به سبد</button></form></article><?php endforeach; ?></div><?php endif; ?>
</main></body></html>
