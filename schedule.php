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


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["activity"])) {
    $activity = $_POST["activity"];
    $day = $_POST["day"];
    $schedule = $_POST["schedule"];
    $username = $_SESSION['username'];


    $insert_schedule_sql = $conn->prepare("INSERT INTO client_schedule (email, activities, day, time) VALUES (?, ?, ?, ?)");
    $insert_schedule_sql->bind_param("ssss", $username, $activity, $day, $schedule);

    if ($insert_schedule_sql->execute()) {
        $_SESSION['success_message'] = "Schedule added successfully!";
    } else {
        $_SESSION['error_message'] = "Error adding schedule: " . $insert_schedule_sql->error;
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_activity"], $_POST["delete_schedule"])) {
    $activityToDelete = $_POST["delete_activity"];
    $scheduleToDelete = $_POST["delete_schedule"];
    $username = $_SESSION['username'];


    $delete_schedule_sql = $conn->prepare("DELETE FROM client_schedule WHERE email = ? AND activities = ? AND time = ?");
    $delete_schedule_sql->bind_param("sss", $username, $activityToDelete, $scheduleToDelete);

    if ($delete_schedule_sql->execute()) {
        $_SESSION['success_message'] = "Schedule deleted successfully!";
    } else {
        $_SESSION['error_message'] = "Error deleting schedule: " . $delete_schedule_sql->error;
    }
}

$conn->close();
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
</head>
<body>
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
                                <?php if (isset($_SESSION['username'])): ?>
                                    <!-- User is logged in -->
                                    <div class="header-right-btn f-right d-none d-lg-block ml-30">
                                        <a href="logout.php" class="btn header-btn">Log Out</a>
                                    </div>
                                <?php else: ?>
                                    <!-- User is not logged in -->
                                    <div class="header-right-btn f-right d-none d-lg-block ml-30">
                                        <a href="form.php" class="btn header-btn">Become a Member</a>
                                    </div>
                                    <div class="header-right-btn f-right d-none d-lg-block ml-30">
                                        <a href="login.php" class="btn header-btn">Log in Monster</a>
                                    </div>
                                <?php endif; ?>
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
        <!--? Hero Start -->
        <div class="slider-area2">
            <div class="slider-height2 d-flex align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="hero-cap hero-cap2 text-center pt-70">
                                <h2>Schedule</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hero End -->
        <!--? Date Tabs Start -->
        <section class="date-tabs section-padding30">
            <div class="container">
                <!-- Heading & Nav Button -->
                <div class="row justify-content-center mb-10">
                    <div class="col-lg-11">
                        <div class="properties__button">
                            <!--Nav Button  -->                                            
                            <nav>      
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="false">Saturday</a>
                                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Sunday</a>
                                    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Monday</a>
                                    <a class="nav-item nav-link" id="nav-last-tab" data-toggle="tab" href="#nav-last" role="tab" aria-controls="nav-contact" aria-selected="false">Tuesday</a>
                                    <a class="nav-item nav-link" id="nav-Sports" data-toggle="tab" href="#nav-nav-Sport" role="tab" aria-controls="nav-contact" aria-selected="false">Wednesday</a>
                                    <a class="nav-item nav-link" id="nav-six" data-toggle="tab" href="#nav-nav-six" role="tab" aria-controls="nav-contact" aria-selected="false">Thursday</a>
                                    <a class="nav-item nav-link" id="nav-seven" data-toggle="tab" href="#nav-nav-seven" role="tab" aria-controls="nav-seven" aria-selected="false">Friday</a>
                                </div>
                            </nav>
                            <!--End Nav Button  -->
                        </div>
                    </div>
                </div>
                <!-- Tab content -->
                <div class="row justify-content-center">
                    <div class="col-lg-11">
                        <!-- Nav Card -->
                        <div class="tab-content" id="nav-tabContent">
                            <!--  one -->
                            <div class="tab-pane fade" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
    <div class="row">
        <div class="col-12">
            <div class="tab-wrapper">
                <!-- single -->
                <?php foreach ($_SESSION['user_activities'] as $activity): ?>
                    <div class="single-box">
                        <div class="single-caption text-center">
                            <div class="caption">
                            
                                <h3><?php echo $activity; ?></h3>
                                <!-- Add a form for each activity -->
                                <form method="post" action="">
                                    <!-- Include hidden fields for the activity and day -->
                                    <input type="hidden" name="activity" value="<?php echo $activity; ?>">
                                    <input type="hidden" name="day" value="Saturday">
                                    
                                    <!-- Add schedule options -->
                                    <label for="morning">Morning</label>
                                    <input type="radio" name="schedule" id="morning" value="Morning" required>
                                    
                                    <label for="afternoon">Afternoon</label>
                                    <input type="radio" name="schedule" id="afternoon" value="Afternoon" required>
                                    
                                    <label for="evening">Evening</label>
                                    <input type="radio" name="schedule" id="evening" value="Evening" required>
                                    
                                    <button type="submit">Select Schedule</button>
                                </form>
                                <form method="post" action="">
            <input type="hidden" name="delete_activity" value="<?php echo $activity; ?>">
            <input type="hidden" name="delete_day" value="<?php echo $day; ?>">
            <input type="hidden" name="delete_schedule" value="<?php echo $schedule; ?>">
            <button type="submit">Delete Schedule</button>
        </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

                            <!--  Two -->
                           <!-- Sunday tab -->
<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
<div class="row">
        <div class="col-12">
            <div class="tab-wrapper">
                <!-- single -->
                <?php foreach ($_SESSION['user_activities'] as $activity): ?>
                    <div class="single-box">
                        <div class="single-caption text-center">
                            <div class="caption">
                               
                                <h3><?php echo $activity; ?></h3>
                                <!-- Add a form for each activity -->
                                <form method="post" action="">
                                    <!-- Include hidden fields for the activity and day -->
                                    <input type="hidden" name="activity" value="<?php echo $activity; ?>">
                                    <input type="hidden" name="day" value="Saturday">
                                    
                                    <!-- Add schedule options -->
                                    <label for="morning">Morning</label>
                                    <input type="radio" name="schedule" id="morning" value="Morning" required>
                                    
                                    <label for="afternoon">Afternoon</label>
                                    <input type="radio" name="schedule" id="afternoon" value="Afternoon" required>
                                    
                                    <label for="evening">Evening</label>
                                    <input type="radio" name="schedule" id="evening" value="Evening" required>
                                    
                                    <button type="submit">Select Schedule</button>
                                </form>
                                <form method="post" action="">
            <input type="hidden" name="delete_activity" value="<?php echo $activity; ?>">
            <input type="hidden" name="delete_day" value="<?php echo $day; ?>">
            <input type="hidden" name="delete_schedule" value="<?php echo $schedule; ?>">
            <button type="submit">Delete Schedule</button>
        </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<!-- Monday tab -->
<div class="tab-pane fade show active" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
<div class="row">
        <div class="col-12">
            <div class="tab-wrapper">
                <!-- single -->
                <?php foreach ($_SESSION['user_activities'] as $activity): ?>
                    <div class="single-box">
                        <div class="single-caption text-center">
                            <div class="caption">
                               
                                <h3><?php echo $activity; ?></h3>
                                <!-- Add a form for each activity -->
                                <form method="post" action="">
                                    <!-- Include hidden fields for the activity and day -->
                                    <input type="hidden" name="activity" value="<?php echo $activity; ?>">
                                    <input type="hidden" name="day" value="Saturday">
                                    
                                    <!-- Add schedule options -->
                                    <label for="morning">Morning</label>
                                    <input type="radio" name="schedule" id="morning" value="Morning" required>
                                    
                                    <label for="afternoon">Afternoon</label>
                                    <input type="radio" name="schedule" id="afternoon" value="Afternoon" required>
                                    
                                    <label for="evening">Evening</label>
                                    <input type="radio" name="schedule" id="evening" value="Evening" required>
                                    
                                    <button type="submit">Select Schedule</button>
                                </form>
                                <form method="post" action="">
            <input type="hidden" name="delete_activity" value="<?php echo $activity; ?>">
            <input type="hidden" name="delete_day" value="<?php echo $day; ?>">
            <input type="hidden" name="delete_schedule" value="<?php echo $schedule; ?>">
            <button type="submit">Delete Schedule</button>
        </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<!-- Tuesday tab -->
<div class="tab-pane fade" id="nav-last" role="tabpanel" aria-labelledby="nav-last-tab">
<div class="row">
        <div class="col-12">
            <div class="tab-wrapper">
                <!-- single -->
                <?php foreach ($_SESSION['user_activities'] as $activity): ?>
                    <div class="single-box">
                        <div class="single-caption text-center">
                            <div class="caption">
                                
                                <h3><?php echo $activity; ?></h3>
                                <!-- Add a form for each activity -->
                                <form method="post" action="">
                                    <!-- Include hidden fields for the activity and day -->
                                    <input type="hidden" name="activity" value="<?php echo $activity; ?>">
                                    <input type="hidden" name="day" value="Saturday">
                                    
                                    <!-- Add schedule options -->
                                    <label for="morning">Morning</label>
                                    <input type="radio" name="schedule" id="morning" value="Morning" required>
                                    
                                    <label for="afternoon">Afternoon</label>
                                    <input type="radio" name="schedule" id="afternoon" value="Afternoon" required>
                                    
                                    <label for="evening">Evening</label>
                                    <input type="radio" name="schedule" id="evening" value="Evening" required>
                                    
                                    <button type="submit">Select Schedule</button>
                                </form>
                                <form method="post" action="">
            <input type="hidden" name="delete_activity" value="<?php echo $activity; ?>">
            <input type="hidden" name="delete_day" value="<?php echo $day; ?>">
            <input type="hidden" name="delete_schedule" value="<?php echo $schedule; ?>">
            <button type="submit">Delete Schedule</button>
        </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<!-- Wednesday tab -->
<div class="tab-pane fade" id="nav-Sports" role="tabpanel" aria-labelledby="nav-Sports">
<div class="row">
        <div class="col-12">
            <div class="tab-wrapper">
                <!-- single -->
                <?php foreach ($_SESSION['user_activities'] as $activity): ?>
                    <div class="single-box">
                        <div class="single-caption text-center">
                            <div class="caption">
                                
                                <h3><?php echo $activity; ?></h3>
                                <!-- Add a form for each activity -->
                                <form method="post" action="">
                                    <!-- Include hidden fields for the activity and day -->
                                    <input type="hidden" name="activity" value="<?php echo $activity; ?>">
                                    <input type="hidden" name="day" value="Saturday">
                                    
                                    <!-- Add schedule options -->
                                    <label for="morning">Morning</label>
                                    <input type="radio" name="schedule" id="morning" value="Morning" required>
                                    
                                    <label for="afternoon">Afternoon</label>
                                    <input type="radio" name="schedule" id="afternoon" value="Afternoon" required>
                                    
                                    <label for="evening">Evening</label>
                                    <input type="radio" name="schedule" id="evening" value="Evening" required>
                                    
                                    <button type="submit">Select Schedule</button>
                                </form>
                                <form method="post" action="">
            <input type="hidden" name="delete_activity" value="<?php echo $activity; ?>">
            <input type="hidden" name="delete_day" value="<?php echo $day; ?>">
            <input type="hidden" name="delete_schedule" value="<?php echo $schedule; ?>">
            <button type="submit">Delete Schedule</button>
        </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<!-- Thursday tab -->
<div class="tab-pane fade" id="nav-nav-six" role="tabpanel" aria-labelledby="nav-six">
<div class="row">
        <div class="col-12">
            <div class="tab-wrapper">
                <!-- single -->
                <?php foreach ($_SESSION['user_activities'] as $activity): ?>
                    <div class="single-box">
                        <div class="single-caption text-center">
                            <div class="caption">
                                <h3><?php echo $activity; ?></h3>
                                <!-- Add a form for each activity -->
                                <form method="post" action="">
                                    <!-- Include hidden fields for the activity and day -->
                                    <input type="hidden" name="activity" value="<?php echo $activity; ?>">
                                    <input type="hidden" name="day" value="Saturday">
                                    
                                    <!-- Add schedule options -->
                                    <label for="morning">Morning</label>
                                    <input type="radio" name="schedule" id="morning" value="Morning" required>
                                    
                                    <label for="afternoon">Afternoon</label>
                                    <input type="radio" name="schedule" id="afternoon" value="Afternoon" required>
                                    
                                    <label for="evening">Evening</label>
                                    <input type="radio" name="schedule" id="evening" value="Evening" required>
                                    
                                    <button type="submit">Select Schedule</button>
                                </form>
                                <form method="post" action="">
            <input type="hidden" name="delete_activity" value="<?php echo $activity; ?>">
            <input type="hidden" name="delete_day" value="<?php echo $day; ?>">
            <input type="hidden" name="delete_schedule" value="<?php echo $schedule; ?>">
            <button type="submit">Delete Schedule</button>
        </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<!-- Friday tab -->
<div class="tab-pane fade" id="nav-nav-seven" role="tabpanel" aria-labelledby="nav-seven">
<div class="row">
        <div class="col-12">
            <div class="tab-wrapper">
                <!-- single -->
                <?php foreach ($_SESSION['user_activities'] as $activity): ?>
                    <div class="single-box">
                        <div class="single-caption text-center">
                            <div class="caption">
            
                                <h3><?php echo $activity; ?></h3>
                                <!-- Add a form for each activity -->
                                <form method="post" action="">
                                    <!-- Include hidden fields for the activity and day -->
                                    <input type="hidden" name="activity" value="<?php echo $activity; ?>">
                                    <input type="hidden" name="day" value="Saturday">
                                    
                                    <!-- Add schedule options -->
                                    <label for="morning">Morning</label>
                                    <input type="radio" name="schedule" id="morning" value="Morning" required>
                                    
                                    <label for="afternoon">Afternoon</label>
                                    <input type="radio" name="schedule" id="afternoon" value="Afternoon" required>
                                    
                                    <label for="evening">Evening</label>
                                    <input type="radio" name="schedule" id="evening" value="Evening" required>
                                    
                                    <button type="submit">Select Schedule</button>
                                </form>
                                <form method="post" action="">
            <input type="hidden" name="delete_activity" value="<?php echo $activity; ?>">
            <input type="hidden" name="delete_day" value="<?php echo $day; ?>">
            <input type="hidden" name="delete_schedule" value="<?php echo $schedule; ?>">
            <button type="submit">Delete Schedule</button>
        </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
                    <!-- End Nav Card -->
                    </div>
                </div>
            </div>
        </section>
        <!-- Date Tabs End -->
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
                                        <li><a href="#">Monday 11am-7pm</a></li>
                                        <li><a href="#"> Tuesday-Friday 11am-8pm</a></li>
                                        <li><a href="#"> Saturday 10am-6pm</a></li>
                                        <li><a href="#"> Sunday 11am-6pm</a></li>
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
                                        <p class="info1">GThe trade war currently ensuing between te US anfd several natxions around thdhe globe, most fiercely with.</p>
                                    </div>
                                </div>
                                <!-- Footer Social -->
                                <div class="footer-social ">
                                    <a href=""><i class="fab fa-facebook-f"></i></a>
                                    <a href=""><i class="fab fa-twitter"></i></a>
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
  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Med Aziz Turki</a>
  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End-->
    </footer>
    <!-- Scroll Up -->
    <div id="back-top" >
        <a title="Go to Top" href="#"> <i class="fas fa-level-up-alt"></i></a>
    </div>

    <!-- JS here -->

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
    
    <!-- counter , waypoint -->
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