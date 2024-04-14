<?php session_start(); ?>

<?php
// Function to calculate the price based on car type and service type
function calculatePrice($carType, $serviceType)
{
    $price = 0;

    // Define price ranges for different car types and service types
    $priceRanges = array(
        'smallCar' => array(
            'BasicWash' => 13,
            'Detailing' => 250,
            'Premium' => 35,
            'Detailing 1 layer polish' => 250,
            'Interior cleaning' => 350,
            'Polish lampu' => 100,
            'Watermark cleaning' => 180,
            'Nano mist' => 25,
            'Tinted' => 30
        ),
        'SUV' => array(
            'BasicWash' => 20,
            'Detailing' => 450,
            'Premium' => 50,
            'Detailing 1 layer polish' => 250,
            'Interior cleaning' => 400,
            'Polish lampu' => 100,
            'Watermark cleaning' => 180,
            'Nano mist' => 45,
            'Tinted' => 30
        ),
        'van' => array(
            'BasicWash' => 30,
            'Detailing' => 650,
            'Premium' => 65,
            'Detailing 1 layer polish' => 250,
            'Interior cleaning' => 450,
            'Polish lampu' => 100,
            'Watermark cleaning' => 180,
            'Nano mist' => 65,
            'Tinted' => 30
        )
    );

    // Calculate the price based on the selected car type and service type
    if (array_key_exists($carType, $priceRanges) && array_key_exists($serviceType, $priceRanges[$carType])) {
        $price = $priceRanges[$carType][$serviceType];
    }

    return $price;

    
}

// Calculate the deposit amount (40% of the final price)
 // This should be the final price of the booking

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Booking Confirmation</title>
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
                    <h2>Booking Confirmation</h2>
                </div>
                <div class="col-12">
                    <a href="index.php">Home</a>
                    <a href="booking2.php">Booking Confirmation</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->
    
    <!-- Confirmation Page Content Start -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 text-center">
                <h2>Your Booking Confirmation</h2>
            </div>
        </div>

        <!-- Display Booking Details -->
<!-- Display Booking Details -->
<div class="row mt-4">
    <div class="col-12 text-center">
        <p><strong>Service Type:</strong> <?php echo $_SESSION['serviceType']; ?></p>
        <p><strong>Car Type:</strong> <?php echo $_SESSION['carType']; ?></p>
        <p><strong>Date:</strong> <?php echo $_SESSION['bookingDate']; ?></p>
        <p><strong>Time:</strong> <?php echo $_SESSION['bookingTime']; ?></p>
        <p><strong>Payment Option:</strong> <?php echo $_SESSION['paymentOption']; ?></p>
        <!-- Calculate and display the price -->

        <?php if ($_SESSION['paymentOption'] === 'offline'): ?>
            
            <?php  
            $price = calculatePrice($_SESSION['carType'], $_SESSION['serviceType']);
            if ($price > 0) {
                echo "<p></p>";
            } else {
                echo "<p></p>";
            }
            
            $deposit = $price * 0.4;
            if ($deposit > 0) {
                echo "<p><strong>Deposit:</strong> RM $deposit</p>";
            } else {
                echo "<p><strong>Deposit:</strong> N/A</p>";
            }
        ?>
            <p>Please pay the deposit first and show the receipt when you walk in, otherwise it will be canceled automatically</p>
            <div class="mx-auto" style="display: inline-block; border-radius: 10px; overflow: hidden; margin-top: 10px;">
                <img src="image/qr.jpg" alt="Online Payment" style="max-width: 100%; border-radius: 10px;">
            </div>
        <?php endif; ?>
        
        <?php

        
        ?>

        <?php if ($_SESSION['paymentOption'] === 'online'): ?>
            <?php  
            $price = calculatePrice($_SESSION['carType'], $_SESSION['serviceType']);
        if ($price > 0) {
            echo "<p><strong>Price:</strong> RM $price</p>";
        } else {
            echo "<p><strong>Price:</strong> N/A</p>";
        }
        ?>
            <p>Please pay here and show the receipt when you walk in, otherwise it will be canceled automatically</p>
            <div class="mx-auto" style="display: inline-block; border-radius: 10px; overflow: hidden; margin-top: 10px;">
                <img src="image/qr.jpg" alt="Online Payment" style="max-width: 100%; border-radius: 10px;">
            </div>
        <?php endif; ?>
    </div>
</div>


        <!-- Additional Confirmation Message or Information -->
        <div class="row mt-4">
            <div class="col-12 text-center">
                <p>Thank you for choosing Taxes City Car Spa! Your booking has been confirmed. You can check your email</p>
                <p>We look forward to serving you on the selected date and time. See you there!</p>
            </div>
        </div>

        <!-- Back to Home Button -->
        <div class="row mt-4">
            <div class="col-12 text-center">
                <button class="btn btn-primary" onclick="window.print()">Print Receipt</button>
                <a href="index.php" class="btn btn-primary">Back to Home</a>
            </div>
        </div>
    </div>

     <br><br>
        <!-- Footer End -->
    <!-- Confirmation Page Content End -->

    <!-- Bootstrap JS, Popper.js and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-c1tAAjOQppz6v8r7Fm5Vv9aDHF49/rvx8+ayyJ99KOTdeM4gdeq5g7yPVNVnpq0Q" crossorigin="anonymous"></script>
</body>
</html>
