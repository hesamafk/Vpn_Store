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

$sql_discount = "SELECT description1, title, description2, src, href FROM categorysection";
$result_discount = $conn->query($sql_discount);
$discounts = [];
if ($result_discount->num_rows > 0) {
    while ($row = $result_discount->fetch_assoc()) {
        $discounts[] = $row;
    }
}

$sql_shopItems = "SELECT title, category, src, offer_price, original_price, comments, sale_status, href FROM `discountsection`";
$result_shopItems = $conn->query($sql_shopItems);
$shopItems = [];
if ($result_shopItems->num_rows > 0) {
    while ($row = $result_shopItems->fetch_assoc()) {
        $shopItems[] = $row;
    }
}

$sql_collect = "SELECT id, title , src, count FROM collect_items";
$result_collect = $conn->query($sql_collect);
$collectItems = [];
if ($result_collect->num_rows > 0) {
    while ($row = $result_collect->fetch_assoc()) {
        $collectItems[$row['id']] = $row;
    }
}

$sql_collectLists = "SELECT item_id, item, href FROM collect_lists";
$result_collectLists = $conn->query($sql_collectLists);
$collectLists = [];
if ($result_collectLists->num_rows > 0) {
    while ($row = $result_collectLists->fetch_assoc()) {
        $collectLists[$row['item_id']][] = $row;
    }
}

$sql_ctasection = "SELECT * FROM ctasection";
$result_ctasection = $conn->query($sql_ctasection);
$ctasection = [];
if ($result_ctasection->num_rows > 0) {
    while($row = $result_ctasection->fetch_assoc()) {
        $ctasection[] = $row;
    }
}

$sql_sponsorsection = "SELECT * FROM sponsorsection";
$result_sponsorsection = $conn->query($sql_sponsorsection);
$sponsorsection = [];
if ($result_sponsorsection->num_rows > 0) {
    while($row = $result_sponsorsection->fetch_assoc()) {
        $sponsorsection[] = $row;
    }
}


    
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
                            <li><a href="<?php echo htmlspecialchars($item['login.php'] ?? ''); ?>"><?php echo htmlspecialchars($item['title'] ?? ''); ?></a></li>
                        <?php endforeach; ?>
                        <li><a href="login.php">حساب من</a></li> 
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
                                <a href="checkout.php" class="icon">
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


<section class="hero-section">
    <div class="overlay"></div>
    <div class="hero-images">
        <?php foreach ($preloader_items as $item): ?>
            <div class="<?php echo htmlspecialchars($item['class']); ?>">
                <img src="<?php echo htmlspecialchars($item['src']); ?>" alt="<?php echo htmlspecialchars($item['alt']); ?>">
            </div>
        <?php endforeach; ?>
    </div>
    <div class="container rtl">
        <div class="row">
            <div class="col-xl-8"></div>
            <div class="col-xl-4 col-lg-12">
                <div class="hero-content">
                    <h4 class="sub-title">کالکشن فصل برند های روز</h4>
                    <h2 class="title">مجموعه فوق العاده <br>برای زنان</h2>
                    <h5 class="price"><span> شروع از </span>500 هزار تومان</h5>
                    <a href="shop.html" class="rr-primary-btn">مشاهده کالکشن</a>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="category-section pt-100 pb-100">
    <div class="container rtl">
        <div class="category-top heading-space space-border">
            <div class="section-heading mb-0">
                <h2 class="section-title">بهترین برای دسته های شما</h2>
                <p>بیش از 29 دسته بندی و هزاران محصول</p>
            </div>
           
            <div class="swiper-arrow">
                <div class="swiper-nav swiper-next"><i class="fa-regular fa-arrow-right"></i></div>
                <div class="swiper-nav swiper-prev"><i class="fa-regular fa-arrow-left"></i></div>
            </div>
        </div>
        <div class="category-carousel swiper">
            <div class="swiper-wrapper">
                <?php foreach ($categories as $category) { ?>
                <div class="swiper-slide">
                    <div class="category-item">
                        <div class="category-img">
                            <img src="<?php echo htmlspecialchars($category['src']); ?>" alt="category">
                        </div>
                        <h3 class="title"><a href="<?php echo htmlspecialchars($category['href']); ?>"><?php echo htmlspecialchars($category['title']); ?></a></h3>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>

<section class="discount-section overflow-hidden pb-100 rtl">
        <div class="row gy-lg-0 gy-4">
            <?php foreach ($discounts as $discount) { ?>
            <div class="col-lg-4 col-md-6">
                <div class="discount-item">
                    <div class="product-overlay"></div>
                    <div class="shape"><img src="assets/img/shapes/dis-shpe.png" alt="shape"></div>
                    <div class="content">
                        <span><?php echo htmlspecialchars($discount['description1']); ?></span>
                        <h3 class="title"><?php echo htmlspecialchars($discount['title']); ?> <br> <?php echo htmlspecialchars($discount['description2']); ?></h3>
                        <a href="<?php echo htmlspecialchars($discount['href']); ?>"><i class="fa-regular fa-plus"></i>مشاهده کالکشن</a>
                    </div>
                    <div class="men"><img src="<?php echo htmlspecialchars($discount['src']); ?>" alt="img"></div>
                </div>
            </div>
            <?php } ?>
        </div>
    </section>
    
    
    <section class="fashion-section pb-100">
        <div class="container rtl">
            <div class="category-top heading-space space-border">
                <div class="section-heading mb-0">
                    <h2 class="section-title">استایل مورد علاقتو ببین</h2>
                    <p>بیش از 29 دسته بندی و هزاران محصول</p>
                </div>
              
                <div class="swiper-arrow">
                    <div class="swiper-nav swiper-next"><i class="fa-regular fa-arrow-right"></i></div>
                    <div class="swiper-nav swiper-prev"><i class="fa-regular fa-arrow-left"></i></div>
                </div>
            </div>
            <div class="shop-carousel swiper">
                <div class="swiper-wrapper">
                    <?php foreach ($shopItems as $item) { ?>
                    <div class="swiper-slide">
                        <div class="shop-item">
                            <div class="shop-thumb">
                                <div class="overlay"></div>
                                <img src="<?php echo htmlspecialchars($item['src']); ?>" alt="shop">
                                <span class="sale"><?php echo htmlspecialchars($item['sale_status']); ?></span>
                                <ul class="shop-list">
                                    <li><a href="cart.html"><i class="fa-regular fa-cart-shopping"></i></a></li>
                                    <li><a href="#"><i class="fa-light fa-heart"></i></a></li>
                                    <li><a href="#"><i class="fa-light fa-eye"></i></a></li>
                                </ul>
                            </div>
                            <div class="shop-content">
                                <span class="category"><?php echo htmlspecialchars($item['category']); ?></span>
                                <h3 class="title"><a href="<?php echo htmlspecialchars($item['href']); ?>"><?php echo htmlspecialchars($item['title']); ?></a></h3>
                                <div class="review-wrap">
                                    <ul class="review">
                                        <li><i class="fa-solid fa-star"></i></li>
                                        <li><i class="fa-solid fa-star"></i></li>
                                        <li><i class="fa-solid fa-star"></i></li>
                                        <li><i class="fa-solid fa-star"></i></li>
                                        <li><i class="fa-solid fa-star"></i></li>
                                    </ul>
                                    <span>(<?php echo htmlspecialchars($item['comments']); ?>)</span>
                                </div>
                                <span class="price"> <span class="offer"><?php echo htmlspecialchars($item['offer_price']); ?></span><?php echo htmlspecialchars($item['original_price']); ?> تومان</span>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
    
 <section class="collect-section pb-100">
        <div class="container rtl">
            <div class="row gy-lg-0 gy-4">
                <div class="col-lg-6">
                    <div class="collect-item">
                        <span>+1500 محصول</span>
                        <h3 class="title">مجموعه زنان</h3>
                        <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ <br> لورم ایپسوم متن ساختگی با</p>
                        <ul class="collect-list">
                            <?php if (isset($collectLists[1])): ?>
                                <?php foreach ($collectLists[1] as $listItem): ?>
                                    <li><a href="<?php echo htmlspecialchars($listItem['href'] ?? '#'); ?>"><?php echo htmlspecialchars($listItem['item'] ?? ''); ?></a></li>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                        <div class="men"><img src="assets/img/images/discount-1.png" alt="discount"></div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="collect-items">
                <?php foreach ($collectItems as $item): ?>
                        <div class="collect-item item-<?php echo $item['id']; ?>">
                            <span><?php echo htmlspecialchars($item['count'] ?? ''); ?></span>
                            <h3 class="title"><?php echo htmlspecialchars($item['title'] ?? ''); ?></h3>
                            <ul class="collect-list">
                                <?php if (isset($collectLists[$item['id']])): ?>
                                    <?php foreach ($collectLists[($item['id']+1)] as $listItem): ?>
                                        <li><a href="<?php echo htmlspecialchars($listItem['href'] ?? '#'); ?>"><?php echo htmlspecialchars($listItem['item'] ?? ''); ?></a></li>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </ul>
                            <div class="men">
                                <img src="<?php echo htmlspecialchars($item['src'] ?? ''); ?>" alt="discount">
                            </div>
                        </div>
                <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    
    
    <section class="cta-section pt-100 pb-100" data-background="assets/img/bg-img/cta-bg.jpg">
        <div class="overlay"></div>
        <div class="container">
            <div class="cta-wrap text-center">
                <span>مجموعه زنانه بهار تابستان 22</span>
                <h2 class="title">-15% تخفیف <br>همه اینجا</h2>
                <a href="shop.html" class="rr-primary-btn cta-btn">مشاهده مجموعه ها</a>
            </div>
        </div>
    </section>
   

   
    <div class="sponsor-section pt-100">
        <div class="container">
            <div class="row sponsor-wrap">
                <?php foreach ($ctasection as $sponsor): ?>
                    <div class="sponsor-item bd-right<?php echo $sponsor['id'] % 2 == 0 ? ' bd-bottom' : ''; ?>">
                        <a href="<?php echo htmlspecialchars($sponsor['href']); ?>">
                            <img src="<?php echo htmlspecialchars($sponsor['src']); ?>" alt="img">
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
   
    
     
    <section class="deal-section pt-100 pb-100">
        <div class="container rtl">
            <div class="row deal-wrap align-items-center">
                <div class="shape"><img src="assets/img/shapes/deal-shape.png" alt="shape"></div>
                <div class="col-xl-5 col-lg-12">
                    <div class="deal-content">
                        <div class="section-heading mb-0">
                            <h2 class="section-title">پیشنهادات امروز</h2>
                            <p>طرح اوریگامی صورتی شیک سه نوع نمای بعدی و <br>همکاری دکوراسیون عالی برای افزودن وسایل تزئینی...</p>
                        </div>
                        <div class="deal-info">
                            <div class="icon">
                                <img src="assets/img/icon/deal-icon.png" alt="icon">
                            </div>
                            <div class="content">
                                <p>پیشنهاد زمان محدود قرارداد منقضی خواهد شد <br> یک 18 آگوست 2024 </p>
                            </div>
                        </div>
                        <a href="shop.html" class="rr-primary-btn deal-btn">مشاهده همه مجموعه ها</a>
                    </div>
                </div>
                <div class="col-xl-7 col-lg-12">
                    <div class="row gy-md-0 gy-4">
                        <?php foreach ($sponsorsection as $item): ?>
                            <div class="col-md-6">
                                <div class="shop-item deal-shop">
                                    <div class="shop-thumb">
                                        <div class="overlay"></div>
                                        <img src="<?php echo htmlspecialchars($item['src']); ?>" alt="shop">
                                        <span class="sale"><?php echo htmlspecialchars($item['sale_status']); ?></span>
                                        <ul class="shop-list">
                                            <li><a href="#"><i class="fa-regular fa-cart-shopping"></i></a></li>
                                            <li><a href="#"><i class="fa-light fa-heart"></i></a></li>
                                            <li><a href="#"><i class="fa-light fa-eye"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="shop-content">
                                        <span class="category"><?php echo htmlspecialchars($item['category']); ?></span>
                                        <h3 class="title"><a href="shop-details.html"><?php echo htmlspecialchars($item['title']); ?></a></h3>
                                        <div class="review-wrap">
                                            <ul class="review">
                                                <?php for ($i = 0; $i < 5; $i++): ?>
                                                    <li><i class="fa-solid fa-star"></i></li>
                                                <?php endfor; ?>
                                            </ul>
                                            <span>(<?php echo htmlspecialchars($item['comments']); ?> نظرات)</span>
                                        </div>
                                        <span class="price"> <span class="offer"><?php echo htmlspecialchars($item['offer_price']); ?></span><?php echo htmlspecialchars($item['original_price']); ?></span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<section class="blog-section pb-100">
    <div class="container rtl">
        <div class="section-heading text-center">
            <h2 class="section-title mb-0">آخرین بینش خبری ما</h2>
        </div>
        <div class="row gy-lg-0 gy-4 justify-content-center">
<?php

$sql_blog_posts = "SELECT * FROM `blog_posts`";
$result_blog_posts = $conn->query($sql_blog_posts);

if ($result_blog_posts->num_rows > 0) {
while($row = $result_blog_posts->fetch_assoc()) {
echo '<div class="col-lg-4 col-md-6">
    <div class="post-card">
        <div class="post-thumb">
            <img src="' . $row["src"] . '" alt="post">
        </div>
        <div class="post-content-wrap">
            <div class="post-content">
                <ul class="post-meta">
                    <li><i class="fa-sharp fa-solid fa-calendar-days"></i>' . $row["comments"] . ' نظر</li>
                    <li><i class="fa-regular fa-tag"></i>' . $row["category"] . '</li>
                </ul>
                <h3 class="title"><a href="' . $row["href"] . '">' . $row["title"] . '</a></h3>
            </div>
            <div class="post-bottom">
                <a href="' . $row["href"] . '" class="read-more">بیشتر بدانید<i class="fa-regular fa-arrow-left"></i></a>
            </div>
        </div>
    </div>
</div>';
}
}
?>
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
                <form action="register.php" class="rr-subscribe-form"> 
                    <input class="form-control" type="email" name="email" placeholder="آدرس ایمیل">
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
