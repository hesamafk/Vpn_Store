-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 29, 2024 at 06:57 AM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `billing_details`
--

DROP TABLE IF EXISTS `billing_details`;
CREATE TABLE IF NOT EXISTS `billing_details` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL,
  `first_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL,
  `last_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL,
  `company` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci DEFAULT NULL,
  `country` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL,
  `street_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL,
  `street_address_2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci DEFAULT NULL,
  `state` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL,
  `city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL,
  `postal_code` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL,
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL,
  `order_notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog_posts`
--

DROP TABLE IF EXISTS `blog_posts`;
CREATE TABLE IF NOT EXISTS `blog_posts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `src` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci DEFAULT NULL,
  `comments` int DEFAULT NULL,
  `title` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci DEFAULT NULL,
  `category` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci DEFAULT NULL,
  `href` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `blog_posts`
--

INSERT INTO `blog_posts` (`id`, `src`, `comments`, `title`, `category`, `href`) VALUES
(1, 'assets/img/blog/post-1.jpg', 3, 'اخبار روز', 'مد در اطراف: بررسی تأثیرات فرهنگی', 'blog-details.html'),
(2, 'assets/img/blog/post-2.jpg', 3, 'اخبار روز', 'پذیرش مد اخلاقی و سازگار با محیط زیست', 'blog-details.html'),
(3, 'assets/img/blog/post-3.jpg', 3, 'اخبار روز', 'چگونه ماشین خود را برای هالووین تزئین کنیم', 'blog-details.html');

-- --------------------------------------------------------

--
-- Table structure for table `carousel arrows`
--

DROP TABLE IF EXISTS `carousel arrows`;
CREATE TABLE IF NOT EXISTS `carousel arrows` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL,
  `href` text CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL,
  `src` text CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `carousel arrows`
--

INSERT INTO `carousel arrows` (`id`, `title`, `href`, `src`) VALUES
(1, 'پوشاک زنانه', 'shop.html', 'assets/img/images/cate-1.png'),
(2, 'کالکشن کفش', 'shop.html', 'assets/img/images/cate-2.png'),
(3, 'کالکشن کیف', 'shop.html', 'assets/img/images/cate-3.png'),
(4, 'مجموعه ساعت', 'shop.html', 'assets/img/images/cate-4.png'),
(5, 'تجهیزات جانبی', 'shop.html', 'assets/img/images/cate-5.png'),
(6, 'عینک آفتابی', 'shop.html', 'assets/img/images/cate-6.png');

-- --------------------------------------------------------

--
-- Table structure for table `categorysection`
--

DROP TABLE IF EXISTS `categorysection`;
CREATE TABLE IF NOT EXISTS `categorysection` (
  `id` int NOT NULL AUTO_INCREMENT,
  `description1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci DEFAULT NULL,
  `description2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci DEFAULT NULL,
  `src` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci DEFAULT NULL,
  `href` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `categorysection`
--

INSERT INTO `categorysection` (`id`, `description1`, `title`, `description2`, `src`, `href`) VALUES
(1, '50% تخفیف ویژه', 'آخرین ترندهای مردانه', 'این فصل', 'assets/img/images/discount-men-1.png', 'shop.html'),
(2, '50% تخفیف ویژه', 'جدیدترین پوشاک کودکان', 'در این فصل', 'assets/img/images/discount-men-2.png', 'shop.html'),
(3, '50% تخفیف ویژه', 'آخرین مد های زنانه', 'فصل جدید', 'assets/img/images/discount-men-3.png', 'shop.html');

-- --------------------------------------------------------

--
-- Table structure for table `collect_items`
--

DROP TABLE IF EXISTS `collect_items`;
CREATE TABLE IF NOT EXISTS `collect_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL,
  `src` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci DEFAULT NULL,
  `count` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `collect_items`
--

INSERT INTO `collect_items` (`id`, `title`, `src`, `count`) VALUES
(1, 'کالکشن مردانه', 'assets/img/images/discount-2.png', 1500),
(2, 'بهترین اکسسوری', 'assets/img/images/discount-3.png', 1500);

-- --------------------------------------------------------

--
-- Table structure for table `collect_lists`
--

DROP TABLE IF EXISTS `collect_lists`;
CREATE TABLE IF NOT EXISTS `collect_lists` (
  `id` int NOT NULL AUTO_INCREMENT,
  `item_id` int DEFAULT NULL,
  `item` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci DEFAULT NULL,
  `href` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `item_id` (`item_id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `collect_lists`
--

INSERT INTO `collect_lists` (`id`, `item_id`, `item`, `href`) VALUES
(1, 1, 'بلیزر', 'shop.html'),
(2, 1, 'بلوز و پیراهن', 'shop.html'),
(3, 1, 'کلاه مجلسی', 'shop.html'),
(4, 1, 'شلوار جین', 'shop.html'),
(5, 1, 'بافتنی', 'shop.html'),
(6, 1, 'شلوار', 'shop.html'),
(7, 1, 'دامن', 'shop.html'),
(8, 1, 'کت و شلوار', 'shop.html'),
(9, 1, 'سویشرت و هودی', 'shop.html'),
(10, 1, 'تی شرت', 'shop.html'),
(11, 1, 'تاپ و بادی', 'shop.html'),
(12, 2, 'بلیزر', 'shop.html'),
(13, 2, 'بلوز و پیراهن', 'shop.html'),
(14, 2, 'کلاه', 'shop.html'),
(15, 2, 'شلوار جین', 'shop.html'),
(16, 3, 'بلیزر', 'shop.html'),
(17, 3, 'بلوز و پیراهن', 'shop.html'),
(18, 3, 'کلاه', 'shop.html'),
(19, 3, 'شلوار جین', 'shop.html');

-- --------------------------------------------------------

--
-- Table structure for table `ctasection`
--

DROP TABLE IF EXISTS `ctasection`;
CREATE TABLE IF NOT EXISTS `ctasection` (
  `id` int NOT NULL AUTO_INCREMENT,
  `src` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci DEFAULT NULL,
  `href` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `ctasection`
--

INSERT INTO `ctasection` (`id`, `src`, `href`) VALUES
(1, 'assets/img/sponsor/sponsor-1.png', '#'),
(2, 'assets/img/sponsor/sponsor-2.png', '#'),
(3, 'assets/img/sponsor/sponsor-3.png', '#'),
(4, 'assets/img/sponsor/sponsor-4.png', '#'),
(5, 'assets/img/sponsor/sponsor-5.png', '#'),
(6, 'assets/img/sponsor/sponsor-6.png', '#'),
(7, 'assets/img/sponsor/sponsor-7.png', '#'),
(8, 'assets/img/sponsor/sponsor-8.png', '#'),
(9, 'assets/img/sponsor/sponsor-9.png', '#'),
(10, 'assets/img/sponsor/sponsor-10.png', '#');

-- --------------------------------------------------------

--
-- Table structure for table `discountsection`
--

DROP TABLE IF EXISTS `discountsection`;
CREATE TABLE IF NOT EXISTS `discountsection` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci DEFAULT NULL,
  `category` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci DEFAULT NULL,
  `src` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci DEFAULT NULL,
  `offer_price` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci DEFAULT NULL,
  `original_price` int DEFAULT NULL,
  `comments` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci DEFAULT NULL,
  `sale_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci DEFAULT NULL,
  `href` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `discountsection`
--

INSERT INTO `discountsection` (`id`, `title`, `category`, `src`, `offer_price`, `original_price`, `comments`, `sale_status`, `href`) VALUES
(1, 'لباس مجلسی مونیکا دیارا', 'Levi’s برند', 'assets/img/shop/shop-1.png', 'جدید', 15, '250 تومان', '157 تومان', 'shop-details.html'),
(2, 'صندل گل مشکی اونیما', 'Levi’s برند', 'assets/img/shop/shop-2.png', 'جدید', 15, '450 تومان', '257 تومان', 'shop-details.html'),
(3, 'ژاکت پانچو بین المللی', 'Levi’s برند', 'assets/img/shop/shop-3.png', 'جدید', 15, '550 تومان', '427 تومان', 'shop-details.html'),
(4, 'کیف پنبه ای اداری ضد آب', 'Levi’s برند', 'assets/img/shop/shop-4.png', 'جدید', 15, '350 تومان', '250 تومان', 'shop-details.html');

-- --------------------------------------------------------

--
-- Table structure for table `footer_items`
--

DROP TABLE IF EXISTS `footer_items`;
CREATE TABLE IF NOT EXISTS `footer_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `footer_items`
--

INSERT INTO `footer_items` (`id`, `icon`, `title`, `description`) VALUES
(1, 'assets/img/icon/footer-1.png', 'ارسال رایگان', 'سفارش بالای 65 تومان'),
(2, 'assets/img/icon/footer-2.png', 'بازگشت رایگان', 'سیاست بازگشت رایگان 30 روزه'),
(3, 'assets/img/icon/footer-3.png', 'پرداخت های امن', 'تمام کارت ها'),
(4, 'assets/img/icon/footer-4.png', 'خدمات مشتری', 'خدمات مشتری درجه یک');

-- --------------------------------------------------------

--
-- Table structure for table `footer_links`
--

DROP TABLE IF EXISTS `footer_links`;
CREATE TABLE IF NOT EXISTS `footer_links` (
  `id` int NOT NULL AUTO_INCREMENT,
  `widget_id` int DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci DEFAULT NULL,
  `href` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `widget_id` (`widget_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `footer_links`
--

INSERT INTO `footer_links` (`id`, `widget_id`, `title`, `href`) VALUES
(1, 2, 'نیویورک', 'contact.html'),
(2, 2, 'لوس آنجلس', 'contact.html'),
(3, 2, 'شیکاکو', 'contact.html'),
(4, 2, 'لاس وگاس', 'contact.html'),
(5, 2, 'واشینگتن', 'contact.html'),
(6, 3, 'تازه رسیده ها', 'shop-grid.html'),
(7, 3, 'پرفروش ترین', 'shop-grid.html'),
(8, 3, 'سبزیجات', 'shop-grid.html'),
(9, 3, 'گوشت تازه', 'shop-grid.html'),
(10, 3, 'غذای دریایی تازه', 'shop-grid.html'),
(11, 4, 'سیاست حفظ حریم خصوصی', 'contact.html'),
(12, 4, 'شرایط و ضوابط', 'contact.html'),
(13, 4, 'با ما تماس بگیرید', 'contact.html'),
(14, 4, 'آخرین خبرها', 'blog-grid.html'),
(15, 4, 'نقشه های سایت ما', 'contact.html');

-- --------------------------------------------------------

--
-- Table structure for table `footer_widgets`
--

DROP TABLE IF EXISTS `footer_widgets`;
CREATE TABLE IF NOT EXISTS `footer_widgets` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `footer_widgets`
--

INSERT INTO `footer_widgets` (`id`, `type`, `title`, `description`) VALUES
(1, 'contact', 'درباره فروشگاه', 'سوالی دارید؟ 24/7 با ما تماس بگیرید<br><a href=\"tel:+989127661646\">+989127661646</a><br>دوشنبه تا جمعه: 8:00 صبح تا 6:00 بعد از ظهر<br>شنبه: 8:00 صبح تا 6:00 بعد از ظهر<br>یکشنبه: سرویس بسته'),
(2, 'store_locations', 'فروشگاه های ما', 'نیویورک<br>لوس آنجلس<br>شیکاکو<br>لاس وگاس<br>واشینگتن'),
(3, 'categories', 'دسته بندی های فروشگاه', 'تازه رسیده ها<br>پرفروش ترین<br>سبزیجات<br>گوشت تازه<br>غذای دریایی تازه'),
(4, 'useful_links', 'لینک های مفید', 'سیاست حفظ حریم خصوصی<br>شرایط و ضوابط<br>با ما تماس بگیرید<br>آخرین خبرها<br>نقشه های سایت ما'),
(5, 'newsletter', 'خبرنامه ما', 'برای دریافت به‌روزرسانی‌ها از جمله ورودی‌های جدید و سایر تخفیف‌ها، در فهرست پستی مشترک شوید');

-- --------------------------------------------------------

--
-- Table structure for table `header1`
--

DROP TABLE IF EXISTS `header1`;
CREATE TABLE IF NOT EXISTS `header1` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL,
  `href` text CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `header1`
--

INSERT INTO `header1` (`id`, `title`, `href`) VALUES
(1, 'درباره ما', 'about.html'),
(2, 'حساب من', 'contact.html'),
(3, 'علاقه مندی ها', 'wishlist.html'),
(4, 'تسویه', 'checkout.html');

-- --------------------------------------------------------

--
-- Table structure for table `header2`
--

DROP TABLE IF EXISTS `header2`;
CREATE TABLE IF NOT EXISTS `header2` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL,
  `subtitle` text CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL,
  `options` text CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `header2`
--

INSERT INTO `header2` (`id`, `title`, `subtitle`, `options`) VALUES
(1, 'انتخاب زبان', 'زبان', 'انگلیسی,فارسی'),
(2, 'واحد پول', 'نوع ارز', 'دلار,تومان,لیر');

-- --------------------------------------------------------

--
-- Table structure for table `header3`
--

DROP TABLE IF EXISTS `header3`;
CREATE TABLE IF NOT EXISTS `header3` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL,
  `subtitle` text CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL,
  `options` text CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `header3`
--

INSERT INTO `header3` (`id`, `title`, `subtitle`, `options`) VALUES
(1, 'کل دسته بندی ها', 'همه دسته ها', 'مد و پوشاک,مواد غذایی,مبلمان');

-- --------------------------------------------------------

--
-- Table structure for table `header4`
--

DROP TABLE IF EXISTS `header4`;
CREATE TABLE IF NOT EXISTS `header4` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci,
  `icons` text CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `header4`
--

INSERT INTO `header4` (`id`, `title`, `description`, `icons`) VALUES
(1, 'تماس با ما', '09127661646', 'fa-regular fa-phone'),
(2, NULL, NULL, 'fa-sharp fa-regular fa-heart'),
(3, 'بد خرید شما.', '13.758.000 تومان', 'fa-light fa-bag-shopping');

-- --------------------------------------------------------

--
-- Table structure for table `header5`
--

DROP TABLE IF EXISTS `header5`;
CREATE TABLE IF NOT EXISTS `header5` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL,
  `href` text CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL,
  `subtitle` text CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci,
  `subhref` text CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `header5`
--

INSERT INTO `header5` (`id`, `title`, `href`, `subtitle`, `subhref`) VALUES
(1, 'خانه', 'index.html', 'دمو مد و پوشاک,دمو مواد غذایی,دمو مبلمان', 'index.html,index-2.html,index-3.html'),
(2, 'فروشگاه', 'shop.html', 'فروشگاه اصلی,فروشگاه گرید,جزئیات فروشگاه,سبد خرید,لیست علاقه مندی ها,صفحه پرداخت', 'shop.html,shop-grid.html,shop-details.html,cart.html,wishlist.html,checkout.html'),
(3, 'زنانه', 'shop-grid.html', '', ''),
(4, 'مردانه', 'shop-grid.html', '', ''),
(5, 'صفحات', '#', 'درباره ما,ورود,عضویت,سوالات متداول,خطا 404', 'about.html,login.html,register.html,faq.html,error.html'),
(6, 'بلاگ ها', 'blog-grid.html', 'بلاگ گرید,بلاگ لیست,جزئیات بلاگ', 'blog-grid.html,blog-grid-2.html,blog-details.html'),
(7, 'ارتباط با ما', 'contact.html', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
CREATE TABLE IF NOT EXISTS `login` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mobileside`
--

DROP TABLE IF EXISTS `mobileside`;
CREATE TABLE IF NOT EXISTS `mobileside` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci,
  `subtitle` text CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci,
  `icons` text CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL,
  `href` text CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `mobileside`
--

INSERT INTO `mobileside` (`id`, `title`, `subtitle`, `icons`, `href`) VALUES
(1, 'آدرس', 'کرج، عظیمیه، میدان مهران', 'fa-light fa-location-dot', NULL),
(2, 'شماره تماس ', '026345879541', 'fa-light fa-phone', 'tel:+01569896654'),
(3, 'آدرس ایمیل', 'اینجا وارد کنید', 'fa-light fa-envelope', 'mailto:info@example.com'),
(4, '', '', 'sk-child sk-bounce1', ''),
(5, '', '', 'sk-child sk-bounce2', ''),
(6, '', '', 'sk-child sk-bounce3', '');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `order_total` decimal(10,2) NOT NULL,
  `shipping_cost` decimal(10,2) NOT NULL,
  `payment_method` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL,
  `order_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(50) COLLATE utf8mb4_persian_ci NOT NULL DEFAULT 'در انتظار پرداخت',
  `total_amount` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE IF NOT EXISTS `order_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `product_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL,
  `category` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `preloader`
--

DROP TABLE IF EXISTS `preloader`;
CREATE TABLE IF NOT EXISTS `preloader` (
  `id` int NOT NULL AUTO_INCREMENT,
  `src` text CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL,
  `alt` text CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL,
  `class` text CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `preloader`
--

INSERT INTO `preloader` (`id`, `src`, `alt`, `class`) VALUES
(1, 'assets/img/images/hero-peoples.png', 'img', 'hero-people'),
(2, 'assets/img/shapes/hero-shape-1.png', 'shape', 'hero-shape'),
(3, 'assets/img/shapes/hero-shape-2.png', 'shape', 'hero-shape-2');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) COLLATE utf8mb4_persian_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_persian_ci NOT NULL,
  `image_url` varchar(255) COLLATE utf8mb4_persian_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_persian_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `registration_page`
--

DROP TABLE IF EXISTS `registration_page`;
CREATE TABLE IF NOT EXISTS `registration_page` (
  `id` int NOT NULL AUTO_INCREMENT,
  `page_title` varchar(255) COLLATE utf8mb4_persian_ci NOT NULL,
  `shape_img` varchar(255) COLLATE utf8mb4_persian_ci NOT NULL,
  `header_title` varchar(255) COLLATE utf8mb4_persian_ci NOT NULL,
  `home_link` text COLLATE utf8mb4_persian_ci,
  `home_text` varchar(255) COLLATE utf8mb4_persian_ci NOT NULL,
  `breadcrumb_icon` varchar(255) COLLATE utf8mb4_persian_ci NOT NULL,
  `current_page_text` varchar(255) COLLATE utf8mb4_persian_ci NOT NULL,
  `section_title` varchar(255) COLLATE utf8mb4_persian_ci NOT NULL,
  `google_login_link` text COLLATE utf8mb4_persian_ci,
  `google_login_img` varchar(255) COLLATE utf8mb4_persian_ci NOT NULL,
  `form_action_url` text COLLATE utf8mb4_persian_ci NOT NULL,
  `input_name_placeholder` varchar(255) COLLATE utf8mb4_persian_ci DEFAULT NULL,
  `input_email_placeholder` varchar(255) COLLATE utf8mb4_persian_ci DEFAULT NULL,
  `input_password_placeholder` varchar(255) COLLATE utf8mb4_persian_ci DEFAULT NULL,
  `subscribe_checkbox_label` text COLLATE utf8mb4_persian_ci,
  `terms_checkbox_label` text COLLATE utf8mb4_persian_ci,
  `submit_button_text` varchar(255) COLLATE utf8mb4_persian_ci NOT NULL,
  `forgot_text` varchar(255) COLLATE utf8mb4_persian_ci DEFAULT NULL,
  `login_link` text COLLATE utf8mb4_persian_ci,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `registration_page`
--

INSERT INTO `registration_page` (`id`, `page_title`, `shape_img`, `header_title`, `home_link`, `home_text`, `breadcrumb_icon`, `current_page_text`, `section_title`, `google_login_link`, `google_login_img`, `form_action_url`, `input_name_placeholder`, `input_email_placeholder`, `input_password_placeholder`, `subscribe_checkbox_label`, `terms_checkbox_label`, `submit_button_text`, `forgot_text`, `login_link`) VALUES
(1, 'ثبت حساب', 'assets/img/shapes/page-header-shape.png', 'ثبت حساب', '#', 'خانه', 'fa-solid fa-angle-left', 'ثبت حساب', 'حساب کاربری برای خود بسازید', '#', 'assets/img/icon/google.png', 'https://html.rrdevs.net/roiser/mail.php', 'اسم شما', 'آدرس ایمیل', 'کلمه عبور', 'مشترک شوید تا از محصولات و پیشنهادات جدید مطلع شوید', 'من قبول میکنم شرایط / سیاست حفظ حریم خصوصی', 'ثبت حساب', 'حساب کاربری دارید؟', 'login.html');

-- --------------------------------------------------------

--
-- Table structure for table `sponsorsection`
--

DROP TABLE IF EXISTS `sponsorsection`;
CREATE TABLE IF NOT EXISTS `sponsorsection` (
  `id` int NOT NULL AUTO_INCREMENT,
  `src` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci DEFAULT NULL,
  `sale_status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci DEFAULT NULL,
  `offer_price` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci DEFAULT NULL,
  `original_price` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci DEFAULT NULL,
  `comments` int DEFAULT NULL,
  `title` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci DEFAULT NULL,
  `category` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `sponsorsection`
--

INSERT INTO `sponsorsection` (`id`, `src`, `sale_status`, `offer_price`, `original_price`, `comments`, `title`, `category`) VALUES
(1, 'assets/img/shop/shop-5.jpg', 'جدید', 'Levi’s برند', 'لباس مجلسی مونیکا دیارا', 15, '250 تومان', '157 تومان'),
(2, 'assets/img/shop/shop-6.jpg', 'جدید', 'Levi’s برند', 'صندل گل مشکی اونیما', 15, '450 تومان', '257 تومان');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_persian_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_persian_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_persian_ci NOT NULL,
  `role` enum('admin','user') COLLATE utf8mb4_persian_ci DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `role`, `created_at`, `last_login`) VALUES
(2, 'حسام', 'hesamafkh@gmail.com', '$2y$10$QfgwrNihl2YwREWe8i63cuBvjx2vG5x4RsYKcVDvQa9J.P4sh7IC2', 'user', '2024-08-28 19:29:32', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
