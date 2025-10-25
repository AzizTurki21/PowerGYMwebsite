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


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["removeClient"])) {
    $removeClientName = $_POST["removeClient"];

    $removeClientSql = $conn->prepare("DELETE FROM client_info WHERE name = ?");
    $removeClientSql->bind_param("s", $removeClientName);

    if ($removeClientSql->execute()) {
        $_SESSION['success_message'] = "Client removed successfully!";
    } else {
        $_SESSION['error_message'] = "Error removing client: " . $conn->error;
    }

    $removeClientSql->close();
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["updateClient"])) {
    $updateClientName = $_POST["updateClient"];
    

    header("Location: updateClient.php?name=" . urlencode($updateClientName));
    exit();
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["addClient"])) {
    $newClientName = $_POST["newName"];
    $newClientEmail = $_POST["newEmail"];
    $newClientPassword = $_POST["newPassword"];
    $newClientPhone = $_POST["newPhone"];
    $newClientActivities = $_POST["newActivities"];
    $newClientFullPrice = $_POST["newFullPrice"];


    $addClientSql = $conn->prepare("INSERT INTO client_info (name, email, password, phone, activites, full_price) VALUES (?, ?, ?, ?, ?, ?)");
    $addClientSql->bind_param("sssssd", $newClientName, $newClientEmail, $newClientPassword, $newClientPhone, $newClientActivities, $newClientFullPrice);

    if ($addClientSql->execute()) {
        $_SESSION['success_message'] = "Client added successfully!";
    } else {
        $_SESSION['error_message'] = "Error adding client: " . $conn->error;
    }

    $addClientSql->close();
}


$clientSql = "SELECT name, email, password, phone, activites, schedule, full_price FROM client_info";
$clientResult = $conn->query($clientSql);


if (!$clientResult) {
    die("Error executing the query: " . $conn->error);
}


$conn->close();
?>


<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> POWER GYM </title>
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
	<link rel="stylesheet" href="assets/css/themify-icons.css">
	<link rel="stylesheet" href="assets/css/slick.css">
	<link rel="stylesheet" href="assets/css/nice-select.css">
	<link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <style> 
    .activity-form {
    display: inline-block;
    margin-right: 10px; /* Adjust the margin as needed */
}
    </style>
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
                                <h2>Clients</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hero End -->
        <!--? Services Area Start -->
        <section class="wantToWork-area w-padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="subscription-box">
                        <h3>All Clients</h3>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Activities</th>
                                        <th>Full Price</th>
                                    </tr>
                                </thead>
                                <tbody> 
                                <?php
                                    while ($row = $clientResult->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $row["name"] . "</td>";
                                        echo "<td>" . $row["email"] . "</td>";
                                        echo "<td>" . $row["phone"] . "</td>";
                                        echo "<td>" . $row["activites"] . "</td>";
                                        echo "<td>" . $row["full_price"] . "</td>";
                                        echo '<td>
                                                <form action="" method="post">
                                                    <input type="hidden" name="removeClient" value="' . $row["name"] . '">
                                                    <button type="submit">Remove</button>
                                                </form>
                                                <form action="" method="post">
                                                    <input type="hidden" name="updateClient" value="' . $row["name"] . '">
                                                    <button type="submit">Update</button>
                                                </form>
                                            </td>';
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-padding20">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="subscription-box">
                        <h3>Add New Client</h3>
                        <form action="" method="post">
                            <!-- Your form fields for adding a new client -->
                            <!-- Example: -->
                            <label for="newName">Name:</label>
                            <input type="text" id="newName" name="newName" required>
                            <label for="newEmail">Email:</label>
                            <input type="email" id="newEmail" name="newEmail" required>
                            <label for="newPhone">Password:</label>
                            <input type="password" id="newPassword" name="newPassword" required>
                            <label for="newPhone">Phone:</label>
                            <input type="tel" id="newPhone" name="newPhone" required>
                            <label for="newActivities">Activities:</label>
                            <input type="text" id="newActivities" name="newActivities">
                            <label for="newFullPrice">Full Price:</label>
                            <input type="number" id="newFullPrice" name="newFullPrice">
                            <input type="hidden" name="addClient" value="">
                            <button type="submit">Add Client</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
        <!-- Services Area End -->
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