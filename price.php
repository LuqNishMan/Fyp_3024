<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Price</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link rel="icon" type="image/x-icon" href="image\car-wash.png">
    <meta content="Free Website Template" name="keywords">
    <meta content="Free Website Template" name="description">

    <?php include 'includes/header.php'; ?>
</head>

<body>
    <!-- Nav Bar Start -->
    <div class="nav-bar">
        <div class="container">
            <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav mr-auto">
                        <a href="index.php" class="nav-item nav-link">Home</a>
                        <a href="about.php" class="nav-item nav-link">About</a>
                        <a href="service.php" class="nav-item nav-link">Service</a>
                        <a href="price.php" class="nav-item nav-link active">Price</a>
                        <a href="booking2.php" class="nav-item nav-link">Booking</a>
                        <a href="location.php" class="nav-item nav-link">Location</a>
                    </div>
            </nav>
        </div>
    </div>
    <!-- Nav Bar End -->


    <!-- Page Header Start -->
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2>Taxes City Car Spa Price</h2>
                </div>
                <div class="col-12">
                    <a href="index.php">Home</a>
                    <a href="">Price</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Price Start -->
    <div id="price" class="price">
        <div class="container">
            <div class="section-header text-center">
                <p>Our Price</p>
                <h2>Choose Your Plan</h2>
            </div>
            <div class="row">

            <div class="owl-carousel testimonials-carousel">
                <div class="col-md-6">
                    <div class="price-item" style="width: 350px;">
                        <div class="price-header">
                            <h3>Basic Wash</h3>
                            <h2><span>RM</span><strong>13- <br>30 </strong><span>.00</span></h2>
                        </div>
                        <div class="price-body">
                            <ul>
                                <li><i class="far fa-check-circle"></i>Seats Washing</li>
                                <li><i class="far fa-check-circle"></i>Exterior Cleaning</li>
                                <li><i class="far fa-times-circle"></i>Vacuum Cleaning</li>
                                <li><i class="far fa-times-circle"></i>Interior Wet Cleaning</li>
                                <li><i class="far fa-times-circle"></i>Window Wiping</li>
                            </ul>
                        </div>
                        <?php
                        if (isset($_SESSION['username'])) {
                            // If the user is logged in, display 'Logout'
                            echo '<div class="price-footer">
                            <a class="btn btn-custom" href="booking2.php">Book Now</a>
                        </div>';
                        } else {
                            //Right-aligned Login link with Dropdown
                            echo '<div class="price-footer">
                            <a class="btn btn-custom" href="login.php">Book Now</a>
                        </div>';
                        }
                        ?>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="price-item featured-item" style="width: 350px;">
                        <div class="price-header">
                            <h3>Detailing</h3>
                            <h2><span>RM</span><strong>250-<br>650</strong><span>.00</span></h2>
                        </div>
                        <div class="price-body">
                            <ul>
                                <li><i class="far fa-check-circle"></i>Seats Washing</li>
                                <li><i class="far fa-check-circle"></i>Vacuum Cleaning</li>
                                <li><i class="far fa-check-circle"></i>Exterior Cleaning</li>
                                <li><i class="far fa-check-circle"></i>Interior Wet Cleaning</li>
                                <li><i class="far fa-check-circle"></i>Window Wiping</li>
                            </ul>
                        </div>
                        <?php
                        if (isset($_SESSION['username'])) {
                            // If the user is logged in, display 'Logout'
                            echo '<div class="price-footer">
                            <a class="btn btn-custom" href="booking2.php">Book Now</a>
                        </div>';
                        } else {
                            //Right-aligned Login link with Dropdown
                            echo '<div class="price-footer">
                            <a class="btn btn-custom" href="login.php">Book Now</a>
                        </div>';
                        }
                        ?>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="price-item" style="width: 350px;">
                        <div class="price-header">
                            <h3>Premium</h3>
                            <h2><span>RM</span><strong>35- <br>65 </strong><span>.00</span></h2>
                        </div>
                        <div class="price-body">
                            <ul>
                                <li><i class="far fa-check-circle"></i>Seats Washing</li>
                                <li><i class="far fa-check-circle"></i>Vacuum Cleaning</li>
                                <li><i class="far fa-check-circle"></i>Exterior Cleaning</li>
                                <li><i class="far fa-check-circle"></i>Interior Wet Cleaning</li>
                                <li><i class="far fa-check-circle"></i>Window Wiping</li>
                            </ul>
                        </div>
                        <?php
                        if (isset($_SESSION['username'])) {
                            // If the user is logged in, display 'Logout'
                            echo '<div class="price-footer">
                            <a class="btn btn-custom" href="booking2.php">Book Now</a>
                        </div>';
                        } else {
                            //Right-aligned Login link with Dropdown
                            echo '<div class="price-footer">
                            <a class="btn btn-custom" href="login.php">Book Now</a>
                        </div>';
                        }
                        ?>
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="price-item featured-item" style="width: 350px;">
                        <div class="price-header">
                            <h3>Detailing 1 layer polish</h3>
                            <h2><span>RM</span><strong>250</strong><span>.00</span></h2>
                        </div>
                        <br>
                        <br>
                        <br>
                        <div class="price-body">
                            <ul>
                                <li><i class="far fa-check-circle"></i>Seats Washing</li>
                                <li><i class="far fa-check-circle"></i>Vacuum Cleaning</li>
                                <li><i class="far fa-check-circle"></i>Exterior Cleaning</li>
                                <li><i class="far fa-check-circle"></i>Interior Wet Cleaning</li>
                                <li><i class="far fa-check-circle"></i>Window Wiping</li>
                            </ul>
                        </div>
                        <?php
                        if (isset($_SESSION['username'])) {
                            // If the user is logged in, display 'Logout'
                            echo '<div class="price-footer">
                            <a class="btn btn-custom" href="booking2.php">Book Now</a>
                        </div>';
                        } else {
                            //Right-aligned Login link with Dropdown
                            echo '<div class="price-footer">
                            <a class="btn btn-custom" href="login.php">Book Now</a>
                        </div>';
                        }
                        ?>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="price-item" style="width: 350px;">
                        <div class="price-header">
                            <h3>Interior cleaning</h3>
                            <h2><span>RM</span><strong>350-<br>450</strong><span>.00</span></h2>
                        </div>
                        <div class="price-body">
                            <ul>
                                <li><i class="far fa-check-circle"></i>Seats Washing</li>
                                <li><i class="far fa-check-circle"></i>Vacuum Cleaning</li>
                                <li><i class="far fa-check-circle"></i>Exterior Cleaning</li>
                                <li><i class="far fa-check-circle"></i>Interior Wet Cleaning</li>
                                <li><i class="far fa-check-circle"></i>Window Wiping</li>
                            </ul>
                        </div>
                        <?php
                        if (isset($_SESSION['username'])) {
                            // If the user is logged in, display 'Logout'
                            echo '<div class="price-footer">
                            <a class="btn btn-custom" href="booking2.php">Book Now</a>
                        </div>';
                        } else {
                            //Right-aligned Login link with Dropdown
                            echo '<div class="price-footer">
                            <a class="btn btn-custom" href="login.php">Book Now</a>
                        </div>';
                        }
                        ?>
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="price-item featured-item" style="width: 350px;">
                        <div class="price-header">
                            <h3>Polish lampu</h3>
                            <h2><span>RM</span><strong>100</strong><span>.00</span></h2>
                        </div>
                        <br>
                        <br>
                        <br>
                        <div class="price-body">
                            <ul>
                                <li><i class="far fa-check-circle"></i>Seats Washing</li>
                                <li><i class="far fa-check-circle"></i>Vacuum Cleaning</li>
                                <li><i class="far fa-check-circle"></i>Exterior Cleaning</li>
                                <li><i class="far fa-check-circle"></i>Interior Wet Cleaning</li>
                                <li><i class="far fa-check-circle"></i>Window Wiping</li>
                            </ul>
                        </div>
                        <?php
                        if (isset($_SESSION['username'])) {
                            // If the user is logged in, display 'Logout'
                            echo '<div class="price-footer">
                            <a class="btn btn-custom" href="booking2.php">Book Now</a>
                        </div>';
                        } else {
                            //Right-aligned Login link with Dropdown
                            echo '<div class="price-footer">
                            <a class="btn btn-custom" href="login.php">Book Now</a>
                        </div>';
                        }
                        ?>
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="price-item" style="width: 350px;">
                        <div class="price-header">
                            <h3>Watermark Cleaning</h3>
                            <h2><span>RM</span><strong>180</strong><span>.00</span></h2>
                        </div>

                        <br>
                        <br>
                        <br>
                        <div class="price-body">
                            <ul>
                                <li><i class="far fa-check-circle"></i>Seats Washing</li>
                                <li><i class="far fa-check-circle"></i>Vacuum Cleaning</li>
                                <li><i class="far fa-check-circle"></i>Exterior Cleaning</li>
                                <li><i class="far fa-check-circle"></i>Interior Wet Cleaning</li>
                                <li><i class="far fa-check-circle"></i>Window Wiping</li>
                            </ul>
                        </div>
                        <?php
                        if (isset($_SESSION['username'])) {
                            // If the user is logged in, display 'Logout'
                            echo '<div class="price-footer">
                            <a class="btn btn-custom" href="booking2.php">Book Now</a>
                        </div>';
                        } else {
                            //Right-aligned Login link with Dropdown
                            echo '<div class="price-footer">
                            <a class="btn btn-custom" href="login.php">Book Now</a>
                        </div>';
                        }
                        ?>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="price-item featured-item" style="width: 350px;">
                        <div class="price-header">
                            <h3>Polish lampu</h3>
                            <h2><span>RM</span><strong>25-<br>65</strong><span>.00</span></h2>
                        </div>
                        <div class="price-body">
                            <ul>
                                <li><i class="far fa-check-circle"></i>Seats Washing</li>
                                <li><i class="far fa-check-circle"></i>Vacuum Cleaning</li>
                                <li><i class="far fa-check-circle"></i>Exterior Cleaning</li>
                                <li><i class="far fa-check-circle"></i>Interior Wet Cleaning</li>
                                <li><i class="far fa-check-circle"></i>Window Wiping</li>
                            </ul>
                        </div>
                        <?php
                        if (isset($_SESSION['username'])) {
                            // If the user is logged in, display 'Logout'
                            echo '<div class="price-footer">
                            <a class="btn btn-custom" href="booking2.php">Book Now</a>
                        </div>';
                        } else {
                            //Right-aligned Login link with Dropdown
                            echo '<div class="price-footer">
                            <a class="btn btn-custom" href="login.php">Book Now</a>
                        </div>';
                        }
                        ?>
                    </div>
                </div>
                <!-- <div class="col-md-4">
                        <div class="price-item">
                            <div class="price-header">
                                <h3>Complex Cleaning</h3>
                                <h2><span>RM</span><strong>00</strong><span>.00</span></h2>
                            </div>
                            <div class="price-body">
                                <ul>
                                    <li><i class="far fa-check-circle"></i>Seats Washing</li>
                                    <li><i class="far fa-check-circle"></i>Vacuum Cleaning</li>
                                    <li><i class="far fa-check-circle"></i>Exterior Cleaning</li>
                                    <li><i class="far fa-check-circle"></i>Interior Wet Cleaning</li>
                                    <li><i class="far fa-check-circle"></i>Window Wiping</li>
                                </ul>
                            </div>
                            <div class="price-footer">
                                <a class="btn btn-custom" href="">Book Now</a>
                            </div>
                        </div> -->
            </div>
        </div>
    </div>
    </div>

    <!-- Price End -->

    <!-- Footer Start -->
    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-8">
                    <div class="footer-contact">
                        <h2>Get in touch with us!</h2>
                        <p><i class="fa fa-map-marker-alt"></i>577 A, Jalan Kubang Kurus, Kampung Pengkalan Pandan, 24000 Chukai, Terengganu</p>
                        <p><i class="fa fa-phone-alt"></i>+6016-864 9597</p>
                        <div class="footer-social">
                            <a class="btn"
                                href="https://www.facebook.com/p/AF-Car-Care-Service-Kuching-100063884779492/"><i
                                    class="fab fa-facebook-f"></i></a>
                            <a class="btn" href=""><i class="fab fa-instagram"></i></a>
                            <a class="btn" href="https://wa.me/60168649597" target="_blank"><i
                                    class="fab fa-whatsapp"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-8">
                    <div class="footer-link">
                        <h2>Find out about us!</h2>
                        <a href="about.php">About Us</a>
                        <a href="location.php">Contact Us</a>
                        <a href="service.php">Our Service</a>
                        <a href="location.php">Location</a>
                        <a href="price.php">Our Price</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>