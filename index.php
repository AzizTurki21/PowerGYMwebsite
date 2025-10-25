<?php
session_start();


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gymdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>

<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> POWERGYM </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/logo/lo.png">

	<!-- CSS here -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/owl.carousel.min.css">
	<link rel="stylesheet" href="assets/css/slicknav.css">
    <link rel="stylesheet" href="assets/css/flaticon.css">
    <link rel="stylesheet" href="assets/css/gijgo.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/animated-headline.css">
	<link rel="stylesheet" href="assets/css/magnific-popup.css">
	<link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
	<link rel="stylesheet" href="assets/css/themify-icons.css">
	<link rel="stylesheet" href="assets/css/slick.css">
	<link rel="stylesheet" href="assets/css/nice-select.css">
	<link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
</head>
<body>

<?php
    // Check if there is an error message in the session
    if (isset($_SESSION['error_message'])) {
        echo '<script>';
        echo 'alert("' . $_SESSION['error_message'] . '");';
        echo '</script>';
        unset($_SESSION['error_message']); // Clear the error message after displaying it
    }
    ?>
    <!-- ? Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="assets/img/logo/load.png" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader Start -->
    <header>
        <!--? Header Start -->
        <div class="header-area header-transparent">
            <div class="main-header header-sticky">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <!-- Logo -->
                        <div class="col-xl-2 col-lg-2 col-md-1">
                            <div class="logo">
                                <a href="index.php"><img src="assets/img/logo/lo.png" alt=""></a>
                            </div>
                        </div>
                        <div class="col-xl-10 col-lg-10 col-md-10">
                            <div class="menu-main d-flex align-items-center justify-content-end">
                                <!-- Main-menu -->
                                <div class="main-menu f-right d-none d-lg-block">
                                    <nav>
                                        <ul id="navigation">
                                            <li><a href="index.php">Home</a></li>
                                            <li><a href="index.php">Contact</a></li>
                                            <li><a href="services.php">Classes</a></li>
                                            <?php if (isset($_SESSION['username'])): ?>
                                                <li><a href="schedule.php">Schedule</a></li> 
                                                <?php if (isset($_SESSION['username']) && 
                                                ($_SESSION['username'] == 'mohamed' || $_SESSION['username'] == 'jebali')): ?>
                                                <li><a href="Clients.php">Clients</a></li> 
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </ul>
                                    </nav>
                                </div>
                                <?php
                                if (isset($_SESSION['username'])) {
                                    // User is logged in, display log out button or other content
                                    ?>
                                    <div class="header-right-btn f-right d-none d-lg-block ml-30">
                                        <a href="logout.php" class="btn header-btn">Log Out</a>
                                    </div>
                                    <?php
                                } else {
                                    // User is not logged in, display login/signup options
                                    ?>
                                    <div class="header-right-btn f-right d-none d-lg-block ml-30">
                                        <a href="form.php" class="btn header-btn">Become a Monster</a>
                                    </div>
                                    <div class="header-right-btn f-right d-none d-lg-block ml-30">
                                        <a href="login.php" class="btn header-btn">Log in Monster</a>
                                    </div>
                                    <?php
                                }
                                ?>
                        </div>   
                        <!-- Mobile Menu -->
                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header End -->
    </header>
    <main>
        <!--? slider Area Start-->
        <div class="slider-area position-relative">
            <div class="slider-active">
                <!-- Single Slider -->
                <div class="single-slider slider-height d-flex align-items-center">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-7 col-lg-9 col-md-8 col-sm-9">
                                <div class="hero__caption">
                                    <span data-animation="fadeInLeft" data-delay="0.1s">with powergym</span>
                                    <h1 data-animation="fadeInLeft" data-delay="0.4s">Build Perfect body Shape for good and Healthy life</h1>
                                </div>
                            </div>
                        </div>
                    </div>          
                </div>
                <!-- Single Slider -->
                <div class="single-slider slider-height d-flex align-items-center">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-7 col-lg-9 col-md-8 col-sm-9">
                                <div class="hero__caption">
                                    <span data-animation="fadeInLeft" data-delay="0.1s">with Power</span>
                                    <h1 data-animation="fadeInLeft" data-delay="0.4s">Build Perfect body Shape for good and Healthy life.</h1>
                                </div>
                            </div>
                        </div>
                    </div>          
                </div>
            </div>
            <!-- Video icon -->
            <div class="video-icon">
                <a class="popup-video btn-icon" href="https://www.youtube.com/watch?v=Fh5VXZELUk8"><i class="fas fa-play"></i></a>
            </div>
        </div>
        <!-- slider Area End-->
        <!--? About Area Start -->
        <section class="about-area section-padding30">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-12">
                        <!-- about-img -->
                        <div class="about-img ">
                            <img src="assets/img/gallery/about.png" alt="">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="about-caption">
                            <!-- Section Tittle -->
                            <div class="section-tittle section-tittle3 mb-35">
                                <span>ABOUT oUR GYM</span>
                                <h2>Efficient and Secure Fitness Solutions Tailored for Optimal Bodybuilding, Saving You Precious Time!</h2>
                            </div>
                            <p class="pera-top">POWERGYM is your ultimate fitness destination, offering top-notch facilities and a vibrant atmosphere. Whether you're a fitness enthusiast or just starting, our cutting-edge equipment and motivating trainers are here to help you achieve your goals.</p>
                            <p class="mb-65 pera-bottom">Join a community that celebrates wellness and embrace the power within you at POWERGYM! 💪✨ #PowerUpYourLife #POWERGYM #FitnessJourney.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- About-2 Area End -->
        <!--? Services Area Start -->
        <section class="services-area pt-100 pb-150 section-bg" data-background="assets/img/gallery/section_bg01.png">
            <!--? Want To work -->
            <section class="wantToWork-area w-padding">
                <div class="container">
                    <div class="row align-items-end justify-content-between">
                        <div class="col-lg-6 col-md-10 col-sm-10">
                            <div class="section-tittle section-tittle2">
                                <span>Our Classes</span>
                                <h2>PUSH YOUR LIMITS FORWARD We Offer to you</h2>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-3">
                            <a href="services.php" class="btn wantToWork-btn f-right">Visit them</a>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Want To work End -->
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <div class="single-cat text-center mb-50">
                            <div class="cat-icon">
                            <i class="fas fa-dumbbell"></i>
                            </div>
                            <div class="cat-cap">
                                <h5><a>Lifting</a></h5>
                                <p>Elevate your strength and sculpt your physique with our Lifting Class. Tailored for all fitness levels, this class focuses on building muscle, enhancing endurance, and achieving your strength goals.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <div class="single-cat text-center mb-50">
                            <div class="cat-icon">
                            <i class="fas fa-heart"></i>
                            </div>
                            <div class="cat-cap">
                                <h5><a>Cardio</a></h5>
                                <p>Rev up your heart rate and torch calories with our Cardio Class. Designed to boost cardiovascular fitness, this dynamic workout offers a mix of high-energy exercises to help you burn fat and improve overall endurance.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <div class="single-cat text-center mb-50">
                            <div class="cat-icon">
                            <i class="fas fa-medal"></i>
                            </div>
                            <div class="cat-cap">
                                <h5><a>Boxing</a></h5>
                                <p>Unleash your inner fighter in our Boxing Class. Whether you're a beginner or seasoned enthusiast, this class combines skill-building and cardiovascular training, providing an empowering and dynamic workout. Step into the ring and discover a new level of strength and confidence.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Services Area End -->
        <!--? About-2 Area Start -->
        <section class="about-area2 testimonial-area section-padding30 fix">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-5 col-md-11 col-sm-11">
                        <!-- about-img -->
                        <div class="about-img2">
                            <img src="assets/img/gallery/about2.png" alt="">
                            <!-- Shape -->
                            <div class="shape-qutaion d-none d-sm-block">
                                <img src="assets/img//gallery/qutaion.png" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-9 col-sm-9">
                        <div class="about-caption">
                            <!-- Section Tittle -->
                            <div class="section-tittle mb-55">
                                <span>Client Feedback</span>
                                <h2>What Our Client thik about our gym</h2>
                            </div>
                            <!-- Testimonial Start -->
                            <div class="h1-testimonial-active">
                                <!-- Single Testimonial -->
                                <div class="single-testimonial">
                                    <div class="testimonial-caption">
                                        <p>POWERGYM has redefined my fitness journey. Their innovative equipment, top-notch trainers, and variety of classes have made every workout enjoyable. The attention to detail in creating a clean and vibrant space sets POWERGYM apart from the rest.</p>
                                        <div class="rattiong-caption">
                                            <span>Jhon Smith<span>Gym Trainer</span> </span>
                                        </div>
                                    </div>
                                </div>
                                <!-- Single Testimonial -->
                                <div class="single-testimonial">
                                    <div class="testimonial-caption">
                                        <p>Choosing POWERGYM was the best decision I made for my fitness goals. The personalized programs and supportive community have transformed my approach to health. The dedication of the trainers and the positive energy in every class make it a gym like no other.</p>
                                        <div class="rattiong-caption">
                                            <span>Sarah Miller<span>Health Advocate</span> </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Testimonial End -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- About-2 Area End -->
        <!--? Gallery Area Start -->
        <div class="gallery-area">
            <div class="container-fluid p-0 fix">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="box snake mb-30">
                            <div class="gallery-img big-img" style="background-image: url(assets/img/gallery/gallery1.png);"></div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="box snake mb-30">
                                    <div class="gallery-img small-img" style="background-image: url(assets/img/gallery/gallery2.png);"></div>
                                </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="box snake mb-30">
                                    <div class="gallery-img small-img" style="background-image: url(assets/img/gallery/gallery3.png);"></div>
                                    
                                </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="box snake mb-30">
                                    <div class="gallery-img small-img" style="background-image: url(assets/img/gallery/gallery4.png);"></div>
                                   
                                </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="box snake mb-30">
                                    <div class="gallery-img small-img" style="background-image: url(assets/img/gallery/gallery5.png);"></div>
                                    
                                </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Gallery Area End -->
        <!--? Want To work -->
        <section class="wantToWork-area w-padding">
            <div class="container">
                <div class="row align-items-end justify-content-between">
                    <div class="col-lg-6 col-md-9 col-sm-9">
                        <div class="section-tittle">
                            <span>oUR TEAM MAMBERS</span>
                            <h2>Our Most Exprienced Trainers</h2>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Want To work End -->
        <!--? Team Ara Start -->
        <div class="team-area pb-150">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="single-team mb-30">
                            <div class="team-img">
                                <img src="assets/img/gallery/aziz.png" alt="">
                                <div class="team-caption">
                                    <span>Director</span>
                                    <h3><a href="#">Med Aziz Turki</a></h3>
                                    <!-- Blog Social -->
                                    <div class="team-social">
                                        <ul>
                                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                            <li><a href="#"><i class="fas fa-globe"></i></a></li>
                                            <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="single-team mb-30">
                            <div class="team-img">
                                <img src="assets/img/gallery/jebali.png" alt="">
                                <div class="team-caption">
                                    <span>Co-Director</span>
                                    <h3><a href="#">Jebali Dhia</a></h3>
                                    <!-- Blog Social -->
                                    <div class="team-social">
                                        <ul>
                                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                            <li><a href="#"><i class="fas fa-globe"></i></a></li>
                                            <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Team Ara End -->
        <!--? Want To work -->
        <section class="wantToWork-area w-padding section-bg" data-background="assets/img/gallery/section_bg02.png">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-xl-6 col-lg-7 col-md-8 col-sm-10">
                        <div class="wantToWork-caption">
                            <h2>April membership offer available Now</h2>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-3">
                        <a href="services.php" class="btn wantToWork-btn f-right">Join Any Class</a>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <footer>
        <!--? Footer Start-->
        <div class="footer-area section-bg" data-background="assets/img/gallery/section_bg03.png">
            <div class="container">
                <div class="footer-top footer-padding">
                    <!-- Footer Menu -->
                    <div class="row d-flex justify-content-between">
                       
                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                            <div class="single-footer-caption mb-50">
                                <div class="footer-tittle">
                                    <h4>Open hour</h4>
                                    <ul>
                                        <li><a href="#"> Monday-Friday 8am-10pm</a></li>
                                        <li><a href="#"> Saturday 8am-8pm</a></li>
                                        <li><a href="#"> Sunday 8am-6pm</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-xl-3 col-lg-4 col-md-5 col-sm-6">
                            <div class="single-footer-caption mb-50">
                                <!-- logo -->
                                <div class="footer-logo">
                                    <a href="index.html"><img src="assets/img/logo/logo2_footer.png" alt=""></a>
                                </div>
                                <div class="footer-tittle">
                                    <div class="footer-pera">
                                        <p class="info1">Navigating the intense global trade landscape, our gym stands resilient against economic challenges. Amidst the currents of the ongoing trade tensions, POWERGYM remains unwavering, 
                                            continuing to prioritize your fitness journey with dedication and strength.</p>
                                    </div>
                                </div>
                                <!-- Footer Social -->
                                <div class="footer-social ">
                                    <a href=""><i class="fab fa-facebook-f"></i></a>
                        
                                    <a href=""><i class="fas fa-globe"></i></a>
                                    <a href=""><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Footer Bottom -->
                <div class="footer-bottom">
                    <div class="row d-flex align-items-center">
                        <div class="col-lg-12">
                            <div class="footer-copy-right text-center">
                                <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Med Aziz Turki</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <div id="back-top" >
        <a title="Go to Top" href="#"> <i class="fas fa-level-up-alt"></i></a>
    </div>


    <script src="./assets/js/vendor/modernizr-3.5.0.min.js"></script>
    <!-- Jquery, Popper, Bootstrap -->
    <script src="./assets/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="./assets/js/popper.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
    <!-- Jquery Mobile Menu -->
    <script src="./assets/js/jquery.slicknav.min.js"></script>

    <!-- Jquery Slick , Owl-Carousel Plugins -->
    <script src="./assets/js/owl.carousel.min.js"></script>
    <script src="./assets/js/slick.min.js"></script>
    <!-- One Page, Animated-HeadLin -->
    <script src="./assets/js/wow.min.js"></script>
    <script src="./assets/js/animated.headline.js"></script>
    <script src="./assets/js/jquery.magnific-popup.js"></script>

    <!-- Date Picker -->
    <script src="./assets/js/gijgo.min.js"></script>
    <!-- Nice-select, sticky -->
    <script src="./assets/js/jquery.nice-select.min.js"></script>
    <script src="./assets/js/jquery.sticky.js"></script>
    
    <!-- counter , waypoint,Hover Direction -->
    <script src="./assets/js/jquery.counterup.min.js"></script>
    <script src="./assets/js/waypoints.min.js"></script>
    <script src="./assets/js/jquery.countdown.min.js"></script>
    <script src="./assets/js/hover-direction-snake.min.js"></script>

    <!-- contact js -->
    <script src="./assets/js/contact.js"></script>
    <script src="./assets/js/jquery.form.js"></script>
    <script src="./assets/js/jquery.validate.min.js"></script>
    <script src="./assets/js/mail-script.js"></script>
    <script src="./assets/js/jquery.ajaxchimp.min.js"></script>
    
    <!-- Jquery Plugins, main Jquery -->	
    <script src="./assets/js/plugins.js"></script>
    <script src="./assets/js/main.js"></script>
    
    </body>
</html>