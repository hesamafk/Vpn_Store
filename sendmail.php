<?php

    error_reporting(0);

    $site_owners_email = 'example@example.com'; // Replace this with your own email address
    $site_owners_name = 'Example'; // replace with your name
    
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $phone = filter_var($_POST['telephone'], FILTER_SANITIZE_STRING);
    $website = filter_var($_POST['website'], FILTER_SANITIZE_STRING);
    $message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);

    require_once('phpmailer/class.phpmailer.php');
    $mail = new PHPMailer();

    $mail->From = $email;
    $mail->FromName = $name;
    $mail->Subject = 'Message from '. $_SERVER['SERVER_NAME'];
    $mail->AddAddress($site_owners_email, $site_owners_name);
    $mail->IsHTML(true);
    $mail->Body = '<b>Name:</b> '. $name .'<br/><b>E-mail:</b> '. $email .'<br/><b>Phone:</b> '. $phone .'<br/><b>Website:</b> '. $website .'<br/><br/><b>Message:</b> ' . $message;

    $mail->Send();

?>
<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Document Title -->
    <title>VPNet</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="favicon.png">

    <!-- CSS Files -->
    <link href="https://fonts.googleapis.com/css?family=Cabin:400,400i,500i,700%7CRoboto:400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap-rtl.min.css">
    <link rel="stylesheet" href="plugins/swiper/swiper.min.css">
    <link rel="stylesheet" href="plugins/magnific-popup/magnific-popup.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="css/style-rtl.css">
    <link rel="stylesheet" href="css/colors/theme-color-1.css">
    <link rel="stylesheet" href="css/custom.css">
</head>

<body>
    <!-- Preloader -->
    <div class="preLoader"></div>

    <!-- Main header -->
    <header class="header">
        <div class="header-top bg-primary" data-animate="fadeInDown" data-delay=".5">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-9">
                        <!-- Header info -->
                        <ul class="header-info list-inline text-white mb-md-0">
                            <li>Your IP : 192.168.0.102</li>
                            <li>Your Location : Dhaka, Bangladesh</li>
                            <li>Your Status : <span>Unprotected</span></li>
                        </ul>
                    </div>
                    <div class="col-md-3 d-none d-md-block">
                        <!-- Header social icons -->
                        <ul class="social-icons text-right list-inline m-0">
                            <li><a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fab fa-google-plus-g"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fab fa-vimeo-v"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="main-header">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-2 col-md-3 col-sm-3 col-9">
                        <!-- Logo -->
                        <div class="logo" data-animate="fadeInUp" data-delay=".7">
                            <a href="index.html">
                                <img src="img/logo.png" alt="VPNet">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-5 col-sm-3 col-3">
                        <nav data-animate="fadeInUp" data-delay=".9">
                            <!-- Header-menu -->
                            <div class="header-menu">
                                <ul>
                                    <li><a href="index.html">Home</a></li>
                                    <li><a href="http://billing.ywhmcs.com/?systpl=VPNet">WHMCS</a></li>
                                    <li>
                                        <a href="#">Pages <i class="fas fa-caret-down"></i></a>
                                        <ul>
                                            <li><a href="about.html">About</a></li>
                                            <li><a href="team.html">Team</a></li>
                                            <li><a href="affiliate.html">Affiliate Program</a></li>
                                            <li><a href="pricing.html">Pricing Plans</a></li>
                                            <li><a href="testimonials.html">Testimonials</a></li>
                                            <li><a href="features.html">Features</a></li>
                                            <li><a href="404.html">404</a></li>
                                            <!-- Third level menu
                                            <li>
                                                <a href="pricing.html">Pricing Plans <i class="fas fa-caret-right"></i></a>
                                                <ul>
                                                    <li><a href="#">Startup</a></li>
                                                    <li><a href="#">Enterprise</a></li>
                                                    <li><a href="#">Standard</a></li>
                                                </ul>
                                            </li>
                                            -->
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#">Blog <i class="fas fa-caret-down"></i></a>
                                        <ul>
                                            <li><a href="blog.html">Default Blog</a></li>
                                            <li><a href="full-width-blog.html">Full Width Blog</a></li>
                                            <li><a href="blog-sidebar-left.html">Blog Sidebar Left</a></li>
                                            <li><a href="no-sidebar-blog.html">No Sidebar Blog</a></li>
                                            <li><a href="blog-details.html">Blog Details</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="faq.html">FAQ</a></li>
                                    <li><a href="contact.html">Contact</a></li>
                                </ul>
                            </div>
                            <!-- End of Header-menu -->
                        </nav>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6 d-none d-sm-block">
                        <!-- Client area -->
                        <ul class="client-area text-right list-inline m-0" data-animate="fadeInUp" data-delay="1.1">
                            <li class="dropdown">
                                <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">My Account <i class="fas fa-caret-down"></i></a>
                                <ul class="dropdown-menu dropdown-menu-right client-links " aria-labelledby="dropdownMenuLink">
                                    <li><a href="#">Sign In</a></li>
                                    <li><a href="#">Sign Up</a></li>
                                </ul>
                            </li>
                            <li><a class="btn btn-secondary" href="http://billing.ywhmcs.com/clientarea.php?systpl=VPNet">Try It Free</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- End of Main header -->

    <!-- Thank you -->
    <section class="pt-5 pb-5 bg-light">
        <div class="container">
            <div class="text-center">
                <h2 class="roboto" data-animate="fadeInUp" data-delay=".1">Thanks "<?php echo $name; ?>". Your message has been sent.</h2>
                <a href="javascript:history.back()" data-animate="fadeInUp" data-delay=".2"><i class="fas fa-arrow-left"></i> Go Back</a>
            </div>
        </div>
    </section>
    <!-- End of 404 content -->

    <!-- Footer -->
    <footer class="main-footer bg-primary pt-4">
        <div class="container">
            <div class="row pb-3">
                <!-- Footer posts -->
                <footer class="main-footer bg-primary pt-4">
                    <div class="container">
                        <div class="row pb-3">
                            <!-- Footer info -->
                            <div class="col-md-4">
                                <div class="footer-info">
                                    <h3 class="text-white" data-animate="fadeInUp" data-delay="0">درباره ما</h3>
                                    <p data-animate="fadeInUp" data-delay=".05">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز</p>
                                    <ul class="footer-contacts list-unstyled">
                                        <li data-animate="fadeInUp" data-delay=".1">
                                            <i class="fas fa-phone"></i>
                                                        <a href="tel:+989123456789" dir="ltr">+98 9123456789</a>
                                        </li>
                                        <li data-animate="fadeInUp" data-delay=".15">
                                            <i class="fas fa-envelope"></i>
                                            <a href="mailto:info.VPNet@yourmail.com">info.VPNet@yourmail.com</a>
                                        </li>
                                        <li data-animate="fadeInUp" data-delay=".2">
                                            <i class="fas fa-map-marker-alt"></i>
                                            <span>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است</span>
                                        </li>
                                    </ul>
                                    <ul class="social-links list-inline mb-0">
                                        <li data-animate="fadeInUp" data-delay=".25"><a href="#" target="_blank"><i
                                                    class="fab fa-facebook-f"></i></a></li>
                                        <li data-animate="fadeInUp" data-delay=".3"><a href="#" target="_blank"><i
                                                    class="fab fa-twitter"></i></a></li>
                                        <li data-animate="fadeInUp" data-delay=".35"><a href="#" target="_blank"><i
                                                    class="fab fa-google-plus-g"></i></a></li>
                                        <li data-animate="fadeInUp" data-delay=".4"><a href="#" target="_blank"><i
                                                    class="fab fa-linkedin-in"></i></a></li>
                                        <li data-animate="fadeInUp" data-delay=".45"><a href="#" target="_blank"><i
                                                    class="fas fa-rss"></i></a></li>
                                        <li data-animate="fadeInUp" data-delay=".5"><a href="#" target="_blank"><i
                                                    class="fab fa-instagram"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- End of Footer info -->
            
                            <!-- Footer posts -->
                            <div class="col-md-4">
                                <div class="footer-posts">
                                    <h3 class="text-white" data-animate="fadeInUp" data-delay=".5">آخرین اخبار/وبلاگ ها</h3>
                                    <div class="single-footer-post clearfix" data-animate="fadeInUp" data-delay=".55">
                                        <a href="#" class="float-left">
                                            <img src="img/posts/post-t.png" alt="">
                                        </a>
                                        <span>نوشته شده در <a href="#">19 خرداد 1401</a></span>
                                        <h4 class="cabin font-weight-normal"><a href="#"> با تولید سادگی نامفهوم از صنعت چاپ</a></h4>
                                        <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ</p>
                                    </div>
            
                                    <div class="single-footer-post clearfix" data-animate="fadeInUp" data-delay=".6">
                                        <a href="#" class="float-left">
                                            <img src="img/posts/post-t2.png" alt="">
                                        </a>
                                        <span>نوشته شده در <a href="#">19 خرداد 1401</a></span>
                                        <h4 class="cabin font-weight-normal"><a href="#"> با تولید سادگی نامفهوم از صنعت چاپ</a></h4>
                                        <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ</p>
                                    </div>
                                    <a href="blog.html" class="roboto text-uppercase" data-animate="fadeInUp" data-delay=".65">مشاهده تمام پست های وبلاگ <i class="fas fa-caret-right"></i></a>
                                </div>
                            </div>
                            <!-- End of Footer posts -->
            
                            <!-- Footer newsletter -->
                            <div class="col-md-4">
                                <div class="footer-newsletter">
                                    <h3 class="text-white" data-animate="fadeInUp" data-delay=".65">خبرنامه</h3>
                                    <p data-animate="fadeInUp" data-delay=".7">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است</p>
                                    <form
                                        action="https://themelooks.us13.list-manage.com/subscribe/post?u=79f0b132ec25ee223bb41835f&amp;id=f4e0e93d1d"
                                        method="post" name="mc-embedded-subscribe-form" target="_blank">
                                        <div class="form-group" data-animate="fadeInUp" data-delay=".75">
                                            <input class="form-control" type="email" name="EMAIL"
                                                placeholder="آدرس ایمیل خود را وارد نمایید" required>
                                        </div>
                                        <div class="subscribe-submit form-group clearfix mb-0" data-animate="fadeInUp"
                                            data-delay=".8">
                                            <button class="btn btn-primary btn-square float-left" type="submit">اشتراک در</button>
                                            <span>نگران نباشید! <br>ایمیل شما منتشر نخواهد شد</span>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- End of Footer newsletter -->
                        </div>
            
                        <div class="bottom-footer">
                            <div class="row">
                                <!-- Copyright -->
                                <div class="col-md-5 order-last order-md-first">
                                    <p class="copyright" data-animate="fadeInDown" data-delay=".85">&copy; تمامی حقوق برای VPNet محفوظ است <a
                                            href="#">VPNet.com</a></p>
                                </div>
            
                                <!-- Footer menu -->
                                <div class="col-md-7 order-first order-md-last">
                                    <ul class="footer-menu list-inline text-md-right mb-md-0" data-animate="fadeInDown"
                                        data-delay=".95">
                                        <li><a href="#">پیوند ها</a></li>
                                        <li>|</li>
                                        <li><a href="#">سیاست حفظ حریم خصوصی</a></li>
                                        <li>|</li>
                                        <li><a href="#">شرایط و ضوابط</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- End of Footer posts -->
        </div>
    </footer>
    <!-- End of Footer -->

    <!-- Back to top -->
    <div class="back-to-top show">
        <a href="#"> <i class="fas fa-arrow-up"></i></a>
    </div>

    <!-- JS Files -->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/fontawesome-all.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="plugins/typed.js/typed.min.js"></script>
    <script src="plugins/waypoints/jquery.waypoints.min.js"></script>
    <script src="plugins/waypoints/sticky.min.js"></script>
    <script src="plugins/swiper/swiper.min.js"></script>
    <script src="plugins/particles.js/particles.min.js"></script>
    <script src="plugins/particles.js/particles.settings.js"></script>
    <script src="plugins/magnific-popup/jquery.magnific-popup.min.js"></script>
    <script src="plugins/parsley/parsley.min.js"></script>
    <script src="plugins/parallax/parallax.min.js"></script>
    <script src="plugins/retinajs/retina.min.js"></script>
    <script src="js/menu.min.js"></script>
    <script src="js/scripts.js"></script>
    <script src="js/custom.js"></script>
</body>
</html>