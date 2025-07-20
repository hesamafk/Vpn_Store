<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>فروشگاه آنلاین</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/css/venobox.min.css">
    <link rel="stylesheet" href="assets/css/odometer.min.css">
    <link rel="stylesheet" href="assets/css/nice-select.css">
    <link rel="stylesheet" href="assets/css/swiper.min.css">
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shop_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("اتصال به پایگاه داده ناموفق: " . $conn->connect_error);
}

$sql_header1 = "SELECT title, href FROM header1";
$result_header1 = $conn->query($sql_header1);
$header1_items = [];
if ($result_header1->num_rows > 0) {
    while($row = $result_header1->fetch_assoc()) {
        $header1_items[] = $row;
    }
}

$sql_header2 = "SELECT title, subtitle, options FROM header2";
$result_header2 = $conn->query($sql_header2);
$header2_items = [];
if ($result_header2->num_rows > 0) {
    while($row = $result_header2->fetch_assoc()) {
        $header2_items[] = $row;
    }
}

$sql_header3 = "SELECT title, subtitle, options FROM header3";
$result_header3 = $conn->query($sql_header3);
$header3_items = [];
if ($result_header3->num_rows > 0) {
    while($row = $result_header3->fetch_assoc()) {
        $header3_items[] = $row;
    }
}

$sql_header4 = "SELECT title, description, icons FROM header4";
$result_header4 = $conn->query($sql_header4);
$header4_items = [];
if ($result_header4->num_rows > 0) {
    while($row = $result_header4->fetch_assoc()) {
        $header4_items[] = $row;
    }
}

$sql_header5 = "SELECT title, href, subtitle, subhref FROM header5";
$result_header5 = $conn->query($sql_header5);
$header5_items = [];
if ($result_header5->num_rows > 0) {
    while($row = $result_header5->fetch_assoc()) {
        $header5_items[] = $row;
    }
}

$sql_carousel = "SELECT title, href, src FROM `carousel arrows`";
$result_carousel = $conn->query($sql_carousel);
$categories = [];
if ($result_carousel->num_rows > 0) {
    while ($row = $result_carousel->fetch_assoc()) {
        $categories[] = $row;
    }
}

$sql_mobileside = "SELECT title, subtitle, href, icons FROM mobileside";
$result_mobileside = $conn->query($sql_mobileside);
$mobileside_items = [];
if ($result_mobileside->num_rows > 0) {
    while ($row = $result_mobileside->fetch_assoc()) {
        $mobileside_items[] = $row;
    }
}

$sql_preloader = "SELECT * FROM preloader";
$result_preloader = $conn->query($sql_preloader);
$preloader_items = [];
if ($result_preloader->num_rows > 0) {
    while ($row = $result_preloader->fetch_assoc()) {
        $preloader_items[] = $row;
    }
}
    
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $first_name = $_POST['fullname-2'];
    $last_name = $_POST['lastname'];
    $company = $_POST['company'];
    $country = $_POST['country'];
    $street_address = $_POST['street'];
    $street_address_2 = $_POST['street-2'];
    $state = $_POST['town'];
    $city = $_POST['city'];
    $postal_code = $_POST['zip'];
    $phone = $_POST['phone'];
    $order_notes = $_POST['message'];
    
    $sql_billing = "INSERT INTO billing_details (email, first_name, last_name, company, country, street_address, street_address_2, state, city, postal_code, phone, order_notes)
                    VALUES ('$email', '$first_name', '$last_name', '$company', '$country', '$street_address', '$street_address_2', '$state', '$city', '$postal_code', '$phone', '$order_notes')";
    
    if ($conn->query($sql_billing) === TRUE) {
        $user_id = $conn->insert_id; 
        
        $order_total = 500; 
        $shipping_cost = 50; 
        $payment_method = "Direct Bank Transfer"; 
        
        $sql_order = "INSERT INTO orders (user_id, order_total, shipping_cost, payment_method)
                      VALUES ('$user_id', '$order_total', '$shipping_cost', '$payment_method')";
        
        if ($conn->query($sql_order) === TRUE) {
            $order_id = $conn->insert_id; 
            
            $order_items = [
                ['product_name' => 'محافظ سرج شیلد', 'category' => 'هدفون', 'quantity' => 1, 'price' => 500],
                ['product_name' => 'عینک اورجینال', 'category' => 'سیستم یو پی اس', 'quantity' => 1, 'price' => 500],
                ['product_name' => 'هودی برند کوچی', 'category' => 'میکروفون هدست', 'quantity' => 1, 'price' => 500]
            ];
            
            foreach ($order_items as $item) {
                $product_name = $item['product_name'];
                $category = $item['category'];
                $quantity = $item['quantity'];
                $price = $item['price'];
                
                $sql_order_item = "INSERT INTO order_items (order_id, product_name, category, quantity, price)
                                   VALUES ('$order_id', '$product_name', '$category', '$quantity', '$price')";
                
                $conn->query($sql_order_item);
            }
            
            echo "سفارش شما با موفقیت ثبت شد.";
        } else {
            echo "خطا در ثبت سفارش: " . $conn->error;
        }
    } else {
        echo "خطا در ذخیره جزئیات صورتحساب: " . $conn->error;
    }
}

$conn->close();
    
    $footerItems = [
    [
        'icon' => 'assets/img/icon/footer-1.png',
        'title' => 'ارسال رایگان',
        'description' => 'سفارش بالای 65 تومان',
    ],
    [
        'icon' => 'assets/img/icon/footer-2.png',
        'title' => 'بازگشت رایگان',
        'description' => 'سیاست بازگشت رایگان 30 روزه',
    ],
    [
        'icon' => 'assets/img/icon/footer-3.png',
        'title' => 'پرداخت های امن',
        'description' => 'تمام کارت ها',
    ],
    [
        'icon' => 'assets/img/icon/footer-4.png',
        'title' => 'خدمات مشتری',
        'description' => 'خدمات مشتری درجه یک',
    ],
];

$footerWidgets = [
    [
        'title' => 'درباره فروشگاه',
        'contact' => [
            'phone' => '+989127661646',
            'hours' => [
                'دوشنبه تا جمعه' => '8:00 صبح تا 6:00 بعد از ظهر',
                'شنبه' => '8:00 صبح تا 6:00 بعد از ظهر',
                'یکشنبه' => 'سرویس بسته',
            ]
        ]
    ],
    [
        'title' => 'فروشگاه های ما',
        'links' => [
            'نیویورک' => 'contact.html',
            'لوس آنجلس' => 'contact.html',
            'شیکاکو' => 'contact.html',
            'لاس وگاس' => 'contact.html',
            'واشینگتن' => 'contact.html'
        ]
    ],
    [
        'title' => 'دسته بندی های فروشگاه',
        'links' => [
            'تازه رسیده ها' => 'shop-grid.html',
            'پرفروش ترین' => 'shop-grid.html',
            'سبزیجات' => 'shop-grid.html',
            'گوشت تازه' => 'shop-grid.html',
            'غذای دریایی تازه' => 'shop-grid.html'
        ]
    ],
    [
        'title' => 'لینک های مفید',
        'links' => [
            'سیاست حفظ حریم خصوصی' => 'contact.html',
            'شرایط و ضوابط' => 'contact.html',
            'با ما تماس بگیرید' => 'contact.html',
            'آخرین خبرها' => 'blog-grid.html',
            'نقشه های سایت ما' => 'contact.html'
        ]
    ],
];

?>


<!-- header-area-start -->
<header class="header sticky-active rtl">
    <div class="top-bar">
        <div class="container">
            <div class="top-bar-inner">
                <div class="top-bar-left">
                    <ul class="top-left-list">
                        <?php foreach ($header1_items as $item): ?>
                            <li><a href="<?php echo htmlspecialchars($item['href'] ?? ''); ?>"><?php echo htmlspecialchars($item['title'] ?? ''); ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="top-bar-middle">
                    <span>ارسال رایگان برای تمامی سفارشات بالای 150 تومان</span>
                </div>
                <div class="top-bar-right">
                    <ul class="top-right-list">
                        <?php foreach ($header2_items as $item): ?>
                        <li>
                            <div class="nice-select select-control country" tabindex="0">
                                <span class="current"><?php echo htmlspecialchars($item['title'] ?? ''); ?></span>
                                <ul class="list">
                                    <li data-value="" class="option selected focus"><?php echo htmlspecialchars($item['subtitle'] ?? '');?></li>
                                    <?php foreach (explode(",", $item['options']) as $option):?>
                                        <li data-value="" class="option"><?=$option?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="header-middle">
        <div class="container rtl">
            <div class="header-middle-inner">
                <div class="header-middle-left">
                    <div class="header-logo d-lg-block">
                        <a href="index.html">
                            <img src="assets/img/logo/logo-1.png" alt="Logo">
                        </a>
                    </div>
                    <div class="category-form-wrap">
                        <div class="nice-select select-control country" tabindex="0">
                            <span class="current">کل دسته بندی ها</span>
                            <ul class="list">
                                <?php foreach ($header3_items as $item): ?>
                                    <li data-value="" class="option selected focus"><?php echo htmlspecialchars($item['subtitle'] ?? ''); ?></li>
                                    <?php foreach (explode(',', $item['options'] ?? '') as $option): ?>
                                        <li data-value="<?php echo htmlspecialchars($option); ?>" class="option"><?php echo htmlspecialchars($option); ?></li>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <form class="header-form" action="#">
                            <input class="form-control" type="text" name="search" placeholder="دنبال چی هستی؟">
                            <button class="submit rr-primary-btn">جستجو کنید</button>
                        </form>
                    </div>
                </div>
                <div class="header-middle-right">
                    <ul class="contact-item-list">
                        <?php foreach ($header4_items as $item): ?>
                            <li>
                                <div class="content">
                                    <span>تماس با ما:</span>
                                    <a class="number" href="tel:+<?php echo htmlspecialchars($item['description'] ?? ''); ?>"><?php echo htmlspecialchars($item['description'] ?? ''); ?></a>
                                </div>
                                <a href="#" class="icon">
                                    <i class="<?php echo htmlspecialchars($item['icons'] ?? ''); ?>"></i>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="primary-header">
        <div class="container">
            <div class="primary-header-inner">
                <div class="header-logo mobile-logo">
                    <a href="index.html">
                        <img src="assets/img/logo/logo-1.png" alt="Logo">
                    </a>
                </div>
                <div class="header-menu-wrap">
                    <div class="mobile-menu-items">
                        <ul>
                            <?php foreach ($header5_items as $item): ?>
                                <li class="menu-item-has-children">
                                    <a href="<?php echo htmlspecialchars($item['href'] ?? ''); ?>"><?php echo htmlspecialchars($item['title'] ?? ''); ?></a>
                                    <?php if ($item['subtitle'] && $item['subhref']): ?>
                                        <ul>
                                            <?php foreach (explode(',', $item['subtitle'] ?? '') as $index => $subtitle): ?>
                                                <li><a href="<?php echo htmlspecialchars(explode(',', $item['subhref'] ?? '')[$index] ?? ''); ?>"><?php echo htmlspecialchars($subtitle); ?></a></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <!-- /.header-menu-wrap -->
                <div class="header-right-wrap">
                    <div class="header-right">
                        <span>کد تخفیف 30 درصدی <span>Roz</span></span>
                        <div class="header-right-item">
                            <a href="javascript:void(0)" class="mobile-side-menu-toggle">
                                <i class="fa-sharp fa-solid fa-bars"></i>
                            </a>
                        </div>
                    </div>
                    <!-- /.header-right -->
                </div>
            </div>
            <!-- /.primary-header-inner -->
        </div>
    </div>
</header>
<!-- header-area-end -->

<div id="popup-search-box">
    <div class="box-inner-wrap d-flex align-items-center">
        <form id="form" action="#" method="get" role="search">
            <input id="popup-search" type="text" name="search" placeholder="Type keywords here...">
        </form>
        <div class="search-close"><i class="fa-sharp fa-regular fa-xmark"></i></div>
    </div>
</div>
<!-- /#popup-search-box -->

<div class="mobile-side-menu rtl">
    <div class="side-menu-content">
        <div class="side-menu-head">
            <a href='index.html'><img src="assets/img/logo/logo-1.png" alt="logo"></a>
            <button class="mobile-side-menu-close"><i class="fa-regular fa-xmark"></i></button>
        </div>
        <div class="side-menu-wrap"></div>
        <ul class="side-menu-list">
            <?php foreach ($mobileside_items as $item): ?>
                <li>
                    <i class="<?php echo htmlspecialchars($item['icons']); ?>"></i>
                    <?php echo htmlspecialchars($item['title']); ?> :
                    <span><?php echo htmlspecialchars($item['subtitle']); ?></span>
                    <?php if ($item['href']): ?>
                        <a href="<?php echo htmlspecialchars($item['href']); ?>"><?php echo htmlspecialchars($item['subtitle']); ?></a>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
<!-- /.mobile-side-menu -->

<div id="preloader">
    <div class="preloader-close">X</div>
    <div class="sk-three-bounce">
        <?php foreach ($preloader_items as $item): ?>
            <div class="sk-child <?php echo htmlspecialchars($item['alt']); ?>"></div>
        <?php endforeach; ?>
    </div>
</div>
<!-- ./ preloader -->

    <!-- بخش سربرگ صفحه -->
    <section class="page-header">
        <div class="shape">
            <img src="assets/img/shapes/page-header-shape.png" alt="shape">
        </div>
        <div class="container rtl">
            <div class="page-header-content">
                <h1 class="title">پرداخت</h1>
                <h4 class="sub-title">
                    <span class="home">
                        <a href="index.html">
                            <span>خانه</span>
                        </a>
                    </span>
                    <span class="icon">
                        <i class="fa-solid fa-angle-left"></i>
                    </span>
                    <span class="inner">
                        <span>پرداخت</span>
                    </span>
                </h4>
            </div>
        </div>
    </section>
    <!-- ./ page-header -->

    <!-- بخش فرم پرداخت -->
    <section class="checkout-section pt-100 pb-100">
        <div class="container rtl">
            <div class="checkout-top">
                <div class="coupon-list">
                    <div class="verify-item mb-30">
                        <h4 class="title">حساب کاربری دارید؟
                            <button type="button" class="rr-checkout-login-form-reveal-btn">کلیک کنید</button> برای ورود
                        </h4>
                        <div id="rrReturnCustomerLoginForm" class="login-form">
                            <form action="https://html.rrdevs.net/roiser/mail.php">
                                <input type="text" id="fullname" name="fullname" class="form-control" placeholder="نام شما">
                                <input type="text" id="password" name="password" class="form-control" placeholder="رمز عبور">
                            </form>
                            <div class="checkbox-wrap">
                                <div class="checkbox-item">
                                    <input type="checkbox" id="vehicle3" name="vehicle3" value="Boat">
                                    <label for="vehicle3">مرا به خاطر بسپار</label>
                                </div>
                                <a href="#" class="forgot">رمز عبور را فراموش کرده‌اید؟</a>
                            </div>
                            <button class="rr-primary-btn">وارد شدن</button>
                        </div>
                    </div>
                    <div class="verify-item">
                        <h4 class="title">کد تخفیف دارید؟
                            <button type="button" class="rr-checkout-login-form-reveal-btn">کلیک کنید</button> برای ورود
                        </h4>
                        <div id="rrCheckoutCouponForm" class="login-form">
                            <form action="https://html.rrdevs.net/roiser/mail.php">
                                <input type="text" id="code" name="code" class="form-control" placeholder="کد تخفیف">
                            </form>
                            <button class="rr-primary-btn">درخواست دادن</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- جزئیات صورتحساب -->
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="checkout-left">
                        <h3 class="form-header">جزئیات صورتحساب</h3>
                        <form action="https://html.rrdevs.net/roiser/mail.php">
                            <div class="checkout-form-wrap">
                                <!-- فیلدهای فرم -->
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="form-item">
                                            <h4 class="form-title">آدرس ایمیل *</h4>
                                            <input type="email" id="email" name="email" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <div class="form-item name">
                                            <h4 class="form-title">نام *</h4>
                                            <input type="text" id="fullname-2" name="fullname-2" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-item">
                                            <h4 class="form-title">نام خانوادگی *</h4>
                                            <input type="text" id="lastname" name="lastname" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="form-item">
                                            <h4 class="form-title">نام شرکت (اختیاری)</h4>
                                            <input type="text" id="company" name="company" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="form-item">
                                            <h4 class="form-title">کشور / منطقه*</h4>
                                            <input type="text" id="country" name="country" class="form-control" placeholder="ایالات متحده (ایالات متحده)">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="form-item">
                                            <h4 class="form-title">آدرس خیابان*</h4>
                                            <input type="text" id="street" name="street" class="form-control street-control" placeholder="شماره خانه و شماره خیابان">
                                            <input type="text" id="street-2" name="street-2" class="form-control street-control-2" placeholder="آپارتمان، سوئیت، واحد و غیره (اختیاری)">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="form-item">
                                            <h4 class="form-title">استان*</h4>
                                            <input type="text" id="town" name="town" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="form-item">
                                            <h4 class="form-title">شهر</h4>
                                            <input type="text" id="city" name="city" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="form-item">
                                            <h4 class="form-title">کد پستی*</h4>
                                            <input type="text" id="zip" name="zip" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="form-item">
                                            <h4 class="form-title">تلفن*</h4>
                                            <input type="text" id="phone" name="phone" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="form-item">
                                            <h4 class="form-title">یادداشت‌های سفارش *</h4>
                                            <textarea id="message" name="message" cols="30" rows="5" class="form-control address"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- سفارش شما -->
                <div class="col-lg-6 col-md-12">
                    <div class="checkout-right">
                        <h3 class="form-header">سفارش شما</h3>
                        <div class="order-box">
                            <div class="order-items">
                                <div class="order-item item-1">
                                    <div class="order-left">
                                        <span class="product">محصول</span>
                                    </div>
                                    <div class="order-right">
                                        <span class="price">قیمت</span>
                                    </div>
                                </div>

                                <!-- آیتم‌های سفارش -->
                                <div class="order-item">
                                    <div class="order-left">
                                        <div class="order-img">
                                            <img src="assets/img/shop/cart-img-1.png" alt="img">
                                        </div>
                                    </div>
                                    <div class="order-right">
                                        <div class="content">
                                            <span class="category">هدفون</span>
                                            <h4 class="title">محافظ سرج شیلد</h4>
                                        </div>
                                        <span class="price">500 تومان</span>
                                    </div>
                                </div>
                                <div class="order-item">
                                    <div class="order-left">
                                        <div class="order-img">
                                            <img src="assets/img/shop/cart-img-2.png" alt="img">
                                        </div>
                                    </div>
                                    <div class="order-right">
                                        <div class="content">
                                            <span class="category">سیستم یو پی اس</span>
                                            <h4 class="title">عینک اورجینال</h4>
                                        </div>
                                        <span class="price">500 تومان</span>
                                    </div>
                                </div>
                                <div class="order-item">
                                    <div class="order-left">
                                        <div class="order-img">
                                            <img src="assets/img/shop/cart-img-3.png" alt="img">
                                        </div>
                                    </div>
                                    <div class="order-right">
                                        <div class="content">
                                            <span class="category">میکروفون هدست</span>
                                            <h4 class="title">هودی برند کوچی</h4>
                                        </div>
                                        <span class="price">500 تومان</span>
                                    </div>
                                </div>

                                <!-- جمع‌بندی سفارش -->
                                <div class="order-item item-1">
                                    <div class="order-left">
                                        <span class="left-title">جمع فرعی</span>
                                    </div>
                                    <div class="order-right">
                                        <span class="right-title">500 تومان</span>
                                    </div>
                                </div>
                                <div class="order-item item-1">
                                    <div class="order-left">
                                        <span class="left-title">حمل و نقل</span>
                                    </div>
                                    <div class="order-right">
                                        <span class="right-title"><span>نرخ ثابت:</span>50 تومان</span>
                                    </div>
                                </div>
                                <div class="order-item item-1">
                                    <div class="order-left">
                                        <span class="left-title">قیمت کل:</span>
                                    </div>
                                    <div class="order-right">
                                        <span class="right-title title-2">550 تومان</span>
                                    </div>
                                </div>
                            </div>

                            <!-- گزینه‌های پرداخت -->
                            <div class="payment-option-wrap">
                                <div class="payment-option">
                                    <div class="shipping-option">
                                        <div class="options">
                                            <input id="flat_rate" type="radio" name="shipping">
                                            <label for="flat_rate">انتقال مستقیم بانکی</label>
                                        </div>
                                        <p class="mb-0">پرداخت خود را مستقیماً به حساب بانکی ما انجام دهید. لطفا از شناسه سفارش خود به عنوان مرجع پرداخت استفاده کنید. سفارش شما تا زمانی که وجوه در حساب ما تسویه نشده باشد ارسال نخواهد شد.</p>
                                    </div>
                                    <div class="shipping-option">
                                        <input id="local_pickup" type="radio" name="shipping">
                                        <label for="local_pickup">پرداخت با چک</label>
                                    </div>
                                    <div class="shipping-option">
                                        <input id="free_shipping" type="radio" name="shipping">
                                        <label for="free_shipping">پرداخت درب منزل</label>
                                    </div>
                                    <div class="shipping-option">
                                        <input id="paypal" type="radio" name="shipping">
                                        <label for="paypal">پی پال</label>
                                    </div>
                                </div>
                                <p class="desc">اطلاعات شخصی شما برای پردازش سفارش شما، پشتیبانی از تجربه شما در سراسر این وب‌سایت و برای اهداف دیگری که در ما توضیح داده شده است، استفاده خواهد شد <span>سیاست حفظ حریم خصوصی.</span></p>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        شرایط و ضوابط را خوانده‌ام و موافقم *
                                    </label>
                                </div>
                                <button class="rr-primary-btn order-btn">سفارش خود را ثبت کنید</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ./ checkout-section -->


<footer class="footer-section bg-grey pt-60">
    <div class="container rtl">
        <div class="footer-items">
            <?php foreach ($footerItems as $item): ?>
            <div class="footer-item">
                <div class="icon">
                    <img src="<?php echo $item['icon']; ?>" alt="icon">
                </div>
                <div class="content">
                    <h4 class="title"><?php echo $item['title']; ?></h4>
                    <span><?php echo $item['description']; ?></span>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="row footer-widget-wrap pb-60">
            <?php foreach ($footerWidgets as $widget): ?>
            <div class="col-lg-<?php echo ($widget['title'] === 'درباره فروشگاه') ? '3' : '2'; ?> col-md-6">
                <div class="footer-widget">
                    <div class="widget-header">
                        <h3 class="widget-title"><?php echo $widget['title']; ?></h3>
                    </div>
                    <?php if (isset($widget['contact'])): ?>
                    <div class="footer-contact">
                        <div class="icon"><i class="fa-sharp fa-solid fa-phone-rotary"></i></div>
                        <div class="content">
                            <span>سوالی دارید؟ 24/7 با ما تماس بگیرید</span>
                            <a href="tel:<?php echo $widget['contact']['phone']; ?>"><?php echo $widget['contact']['phone']; ?></a>
                        </div>
                    </div>
                    <ul class="schedule-list">
                        <?php foreach ($widget['contact']['hours'] as $day => $time): ?>
                        <li><span><?php echo $day; ?>:</span><?php echo $time; ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <?php elseif (isset($widget['links'])): ?>
                    <ul class="footer-list">
                        <?php foreach ($widget['links'] as $text => $url): ?>
                        <li><a href="<?php echo $url; ?>"><?php echo $text; ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
            
            <div class="col-lg-3 col-md-6">
                <div class="footer-widget">
                    <div class="widget-header">
                        <h3 class="widget-title">خبرنامه ما</h3>
                    </div>
                    <div class="news-form-wrap">
                        <p class="mb-20">برای دریافت به‌روزرسانی‌ها از جمله ورودی‌های جدید و سایر تخفیف‌ها، در فهرست پستی مشترک شوید</p>
                        <div class="footer-form mb-20">
                            <form action="#" class="rr-subscribe-form">
                                <input class="form-control" type="email" name="email" placeholder="آدرس ایمیل">
                                <input type="hidden" name="action" value="mailchimpsubscribe">
                                <button class="submit">عضویت</button>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                        <p class="mb-0">من می خواهم اخبار و پیشنهاد ویژه را دریافت کنم</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright-area">
        <div class="container">
            <div class="row copyright-content">
                <div class="col-lg-6">
                    <div class="footer-img-wrap">
                        <span>سیستم پرداخت:</span>
                        <div class="footer-img"><a href="#"><img src="assets/img/images/footer-img-1.png" alt="img"></a></div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <p>تمامی حقوق محفوظ <span>میباشد</span></p>
                </div>
            </div>
        </div>
    </div>
</footer>

<div id="scroll-percentage"><span id="scroll-percentage-value"></span></div>
<!--scrollup-->


<!-- JS here -->
<script src="assets/js/vendor/jquary-3.6.0.min.js"></script>
<script src="assets/js/vendor/bootstrap-bundle.js"></script>
<script src="assets/js/vendor/imagesloaded-pkgd.js"></script>
<script src="assets/js/vendor/waypoints.min.js"></script>
<script src="assets/js/vendor/venobox.min.js"></script>
<script src="assets/js/vendor/odometer.min.js"></script>
<script src="assets/js/vendor/meanmenu.js"></script>
<script src="assets/js/vendor/smooth-scroll.js"></script>
<script src="assets/js/vendor/jquery.isotope.js"></script>
<script src="assets/js/vendor/countdown.js"></script>
<script src="assets/js/vendor/swiper.min.js"></script>
<script src="assets/js/vendor/nice-select.js"></script>
<script src="assets/js/ajax-form.js"></script>
<script src="assets/js/contact.js"></script>
<script src="assets/js/main.js"></script>
</body>
</html>
