<?php session_start()?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Customer Booking</title>
    <link rel="icon" type="image/x-icon" href="image\car-wash.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    
    <?php include 'includes/header.php'; ?>
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <!--Nav Bar Start-->
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
                        <a href="price.php" class="nav-item nav-link">Price</a>
                        <a href="booking2.php" class="nav-item nav-link active">Booking</a>
                        <a href="location.php" class="nav-item nav-link">Location</a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!--Nav Bar End-->

    <!-- Page Header Start -->
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2>Booking Services</h2>
                </div>
                <div class="col-12">
                    <a href="index.php">Home</a>
                    <a href="booking2.php">Booking</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

<!-- Booking Form Start -->
<div class="container mt-8">
    <div class="booking-form">
        <form id="carWashForm" action="process_booking2.php" method="POST">
            <div class="form-group">
                <label for="telephoneNumber">Telephone Number:</label>
                <input type="text" class="form-control" id="telephoneNumber" name="telephoneNumber">
            </div>

            <div class="form-group">
                <label for="vehicleNumber">Vehicle Number:</label>
                <input type="text" class="form-control" id="vehicleNumber" name="vehicleNumber">
            </div>
            <div class="form-group">
                <label for="serviceType">Select Service Type:</label>
                <select class="form-select" id="serviceType" name="serviceType">
                    <option value="" disabled selected>Please Choose</option>
                    <option value="BasicWash">Basic Wash</option>
                    <option value="Detailing">Detailing</option>
                    <option value="Premium">Premium</option>
                    <option value="Detailing 1 layer polish">Detailing 1 layer polish</option>
                    <option value="Interior cleaning ">Interior cleaning </option>
                    <option value="Polish lampu">Polish lampu</option>
                    <option value="Watermark cleaning">Watermark cleaning</option>
                    <option value="Nano mist">Nano mist</option>
                    <option value="Tinted">Tinted</option>
                </select>
            </div>

            <div class="form-group">
                <label for="carType">Select Car Type:</label>
                <select class="form-select" id="carType" name="carType">
                    <option value="" disabled selected>Please Choose</option>
                    <option value="smallCar">Small Car</option>
                    <option value="SUV">SUV</option>
                    <option value="van">Van</option>
                </select>
            </div>

            <div class="form-group">
                <label for="bookingDate">Select Date:</label>
                <input type="date" class="form-control" id="bookingDate" name="bookingDate">
            </div>

            <div class="form-group">
                <label for="bookingTime">Select Time:</label>
                <select class="form-select" id="bookingTime" name="bookingTime">
                    <option value="" disabled selected>Please Choose</option>
                    <!-- Dynamically generate time options in 12-hour format -->
                    <script>
                        for (let i = 8; i <= 18; i++) {
                            var hour = i % 12 || 12;
                            var suffix = i < 12 ? 'AM' : 'PM';

                            document.write('<option value="' + i + ':00 ' + suffix + '">' + hour + ':00 ' + suffix + '</option>');
                            document.write('<option value="' + i + ':30 ' + suffix + '">' + hour + ':30 ' + suffix + '</option>');
                        }
                    </script>
                </select>
            </div>

            <div class="form-group">
                <label for="specialInstructions">Special Instructions (If Any):</label>
                <textarea class="form-control" id="specialInstructions" name="specialInstructions" rows="3"></textarea>
            </div>

            <div class="form-group">
                <label for="paymentOption">Select Payment Option:</label>
                <select class="form-select" id="paymentOption" name="paymentOption">
                    <option value="" disabled selected>Please Choose</option>
                    <option value="online">Online</option>
                    <option value="offline">Offline</option>
                </select>
            </div>

            <br><br>
            <div class="form-group text-center">
                <button <?php if (isset($_SESSION['username'])) {
                        // If the user is logged in, can submit
                        echo 'type=submit onclick="validateBooking()"';
                    } else {
                        // If user is logged out will go to login page
                        echo 'type=button onclick="window.location.href=\'login.php\'"';
                    } ?> class="btn btn-primary" >Book Now</button>
            </div>

        </form>
        <div id="error-message" class="error-message"></div>
    </div>
</div>
<!-- Booking Form End -->

<script>
    // Add your validation logic here
    function validateBooking() {
        // Get form elements
        var serviceType = document.getElementById("serviceType").value;
        var carType = document.getElementById("carType").value;
        var bookingDate = document.getElementById("bookingDate").value;
        var bookingTime = document.getElementById("bookingTime").value;
        var paymentOption = document.getElementById("paymentOption").value;
        var telephoneNumber = document.getElementById("telephoneNumber").value;
        var vehicleNumber = document.getElementById("vehicleNumber").value;
        var specialInstructions = document.getElementById("specialInstructions").value;

        // Validate form inputs
        if (
            serviceType === "" ||
            carType === "" ||
            bookingDate === "" ||
            bookingTime === "" ||
            paymentOption === "" ||
            telephoneNumber === "" ||
            vehicleNumber === ""
        ) {
            alert("All fields are required.");
        } else {
            document.getElementById("error-message").innerHTML = "";

            // Determine price based on car type
            var priceRange = getPriceRange(carType);

            // Validate time range (8 am to 6 pm)
            var selectedHour = parseInt(bookingTime.split(":")[0]);
            var selectedMinutes = parseInt(bookingTime.split(":")[1]);

            if (
                (selectedHour > 8 || (selectedHour === 8 && selectedMinutes >= 0)) &&
                (selectedHour < 18 || (selectedHour === 18 && selectedMinutes <= 0))
            ) {
                // Redirect to bookingconfirmation.php after successful booking
                window.location.href =
                    "bookingconfirmation1.php?serviceType=" +
                    encodeURIComponent(serviceType) +
                    "&carType=" +
                    encodeURIComponent(carType) +
                    "&bookingDate=" +
                    encodeURIComponent(bookingDate) +
                    "&bookingTime=" +
                    encodeURIComponent(bookingTime) +
                    "&paymentOption=" +
                    encodeURIComponent(paymentOption) +
                    "&telephoneNumber=" +
                    encodeURIComponent(telephoneNumber) +
                    "&vehicleNumber=" +
                    encodeURIComponent(vehicleNumber) +
                    "&specialInstructions=" +
                    encodeURIComponent(specialInstructions) +
                    "&priceRange=" +
                    encodeURIComponent(priceRange);
            } else {
                alert("Please select a time between 8 am and 6 pm.");
            }
        }
    }

    // Function to get the price range based on car type
    function getPriceRange(carType) {
        switch (carType) {
            case "smallCar":
                return "RM 12-15";
            case "SUV":
            case "van":
                return "RM 20-25";
            default:
                return "N/A";
        }
    }
</script>
        <!-- Bootstrap JS, Popper.js and dependencies -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-c1tAAjOQppz6v8r7Fm5Vv9aDHF49/rvx8+ayyJ99KOTdeM4gdeq5g7yPVNVnpq0Q" crossorigin="anonymous"></script>
    </body>
</html>