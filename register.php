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
    
$sql = "SELECT * FROM registration_page WHERE id = 1"; 
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $data = $result->fetch_assoc();
} else {
    echo "داده‌ای یافت نشد.";
    exit();
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
              
                <div class="header-right-wrap">
                    <div class="header-right">
                        <span>کد تخفیف 30 درصدی <span>Roz</span></span>
                        <div class="header-right-item">
                            <a href="javascript:void(0)" class="mobile-side-menu-toggle">
                                <i class="fa-sharp fa-solid fa-bars"></i>
                            </a>
                        </div>
                    </div>
                    
                </div>
            </div>
            
        </div>
    </div>
</header>


<div id="popup-search-box">
    <div class="box-inner-wrap d-flex align-items-center">
        <form id="form" action="#" method="get" role="search">
            <input id="popup-search" type="text" name="search" placeholder="Type keywords here...">
        </form>
        <div class="search-close"><i class="fa-sharp fa-regular fa-xmark"></i></div>
    </div>
</div>


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


<div id="preloader">
    <div class="preloader-close">X</div>
    <div class="sk-three-bounce">
        <?php foreach ($preloader_items as $item): ?>
            <div class="sk-child <?php echo htmlspecialchars($item['alt']); ?>"></div>
        <?php endforeach; ?>
    </div>
</div>


<section class="page-header">
    <div class="shape"><img src="assets/img/shapes/page-header-shape.png" alt="shape"></div>
    <div class="container rtl">
        <div class="page-header-content">
            <h1 class="title"><?php echo htmlspecialchars($data['page_title']); ?></h1>
            <h4 class="sub-title">
                <span class="home">
                    <a href="#">
                        <span><?php echo htmlspecialchars($data['home_text']); ?></span>
                    </a>
                </span>
                <span class="icon"><i class="fa-solid fa-angle-left"></i></span>
                <span class="inner">
                    <span><?php echo htmlspecialchars($data['header_title']); ?></span>
                </span>
            </h4>
        </div>
    </div>
</section>




<section class="login-area pt-100 pb-100">
    <div class="container">
        <div class="login-wrap text-center">
            <h3 class="title">حساب کاربری برای خود بسازید</h3>
            <a href="<?php echo htmlspecialchars($data['google_login_link']); ?>" class="google-login">
                <img src="<?php echo htmlspecialchars($data['google_login_img']); ?>" alt="google">با گوگل وارد شوید
            </a>
            <span class="or-text">یا</span>
            <form action="<?php echo htmlspecialchars($data['form_action_url']); ?>" class="login-form">
                <div class="form-item">
                    <h4 class="form-header">* اسم شما</h4>
                    <input type="text" id="name" name="name" class="form-control" placeholder="<?php echo htmlspecialchars($data['input_name_placeholder']); ?>">
                </div>
                <div class="form-item">
                    <h4 class="form-header">* آدرس ایمیل</h4>
                    <input type="text" id="email" name="email" class="form-control" placeholder="<?php echo htmlspecialchars($data['input_email_placeholder']); ?>">
                </div>
                <div class="form-item">
                    <h4 class="form-header">* کلمه عبور</h4>
                    <input type="text" id="text-2" name="text-2" class="form-control" placeholder="<?php echo htmlspecialchars($data['input_password_placeholder']); ?>">
                </div>
                <div class="form-item">
                    <div class="checkbox-wrap mb-10">
                        <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                        <label for="vehicle1"><?php echo htmlspecialchars($data['subscribe_checkbox_label']); ?></label><br>
                    </div>
                    <div class="checkbox-wrap">
                        <input type="checkbox" id="vehicle2" name="vehicle2" value="Bike">
                        <label for="vehicle2"><?php echo htmlspecialchars($data['terms_checkbox_label']); ?></label><br>
                    </div>
                </div>
                <div class="submit-btn">
                    <button class="rr-primary-btn"><?php echo htmlspecialchars($data['submit_button_text']); ?></button>
                </div>
                <div class="login-btn-wrap">
                    <a href="<?php echo htmlspecialchars($data['login_link']); ?>" class="forgot">حساب کاربری دارید؟</a>
                    <a class="log-in" href="<?php echo htmlspecialchars($data['login_link']); ?>">وارد شدن</a>
                </div>
            </form>
        </div>
    </div>
</section>

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
