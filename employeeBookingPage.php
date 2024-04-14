<?php
include("dbConnection.php");
session_start();

if (isset($_SESSION["username"]) && $_SESSION["username"] == "employee") {
    // Code for employee access
} else {
    // Access denied, redirect to index page
    header("Location: index.php");
    exit(); // Ensure that no further code is executed after the redirect
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Employee Booking Page</title>
    <link rel="icon" type="image/x-icon" href="image\car-wash.png">
    <?php include 'includes/header.php'; ?>
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

    <!--Nav Bar Start-->
    <div class="nav-bar">
        <div class="container">
            <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>


                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav">
                        <!-- Home link with image -->
                        <a href="index.php" class="nav-item nav-link pr-0">
                            <img src="image\logo.png" class="w-75" alt="">
                        </a>

                        <a href="employeeBookingPage.php" class="nav-item nav-link active">Pending Booking</a>
                        <a href="employeeBookingHistory.php" class="nav-item nav-link">Booking History</a>
                    </div>

                    <!-- Logout button -->
                    <div class="navbar-nav">
                        <a href="logout.php" class="nav-item nav-link">Logout</a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!--Nav Bar End-->

    <div class="container">
        <div class="table-responsive table-hover mt-4">
            <table class="table table-bordered" id="bookingTable">
                <thead class="thead-light">
                    <tr>
                        <th>Booking ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Table Updated Using JQuery Ajax -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

<script>
    $(document).ready(function () {
        // Load initial booking data when the page loads
        loadBookingData();
    });

    function loadBookingData() {
        // Send an AJAX request to fetch updated booking data
        $.ajax({
            url: 'ajaxEmployee.php',
            type: 'POST',
            data: {
                'request': 'loadBookingData',
            },
            dataType: 'json',
            success: function(data) {
                // Handle the success response here
                updateTable(data);
            },
            error: function(error) {
                // Handle the error response here
                console.error('Error fetching booking data:', error);
            }
        });
    }

    function updateTable(data) {
        // Clear the existing table rows
        $('#bookingTable tbody').empty();

        // Loop through the data and populate the table
        data.forEach(function (row) {
            $('#bookingTable tbody').append('<tr>' +
                '<td>' + row['booking_id'] + '</td>' +
                '<td>' + row['username'] + '</td>' +
                '<td>' + row['email'] + '</td>' +
                '<td>' + row['date'] + '</td>' +
                '<td>' + row['time'] + '</td>' +
                '<td>' + row['bookingStatus'] + '</td>' + // Display bookingStatus from data
                '<td>' +
                '<button class="btn btn-primary" onclick="approveBooking(\'' + row['booking_id'] + '\', \'' + row['email'] + '\', \'' + row['vehicle'] + '\', \'' + row['serviceType'] + '\', \'' + row['special']  + '\', \'' + row['paymentOption'] + '\', \'' + row['date'] + '\', \'' + row['time'] + '\')">Approve</button>' +
                '<button class="btn btn-danger ml-1" onclick="cancelBooking(\'' + row['booking_id'] + '\', \'' + row['email'] + '\', \'' + row['vehicle'] + '\', \'' + row['serviceType'] + '\', \'' + row['special'] + '\', \'' + row['paymentOption'] + '\', \'' + row['date'] + '\', \'' + row['time'] + '\')">Cancel</button>' +
                '</td>' +
                '</tr>');
        });
    }

    function approveBooking(bookingId, email, vehicleNumber, serviceType, specialInstructions, paymentOption, date, time) {
        // Send an AJAX request to approve the booking
        $.ajax({
            url: 'ajaxEmployee.php',
            type: 'POST',
            data: {
                'request': 'approveBooking',
                bookingId: bookingId,
                email: email,
                vehicleNumber: vehicleNumber,
                serviceType: serviceType,
                specialInstructions: specialInstructions,
                paymentOption: paymentOption,
                date: date,
                time: time
            },
            success: function(data) {
                console.log(data);
                // Handle the success response here
                console.log('Booking Approved:', bookingId);
                // You can update the UI or perform any other actions as needed
                loadBookingData();
            },
            error: function(error) {
                // Handle the error response here
                console.error('Error approving booking:', error);
            }
        });
    }

    function cancelBooking(bookingId, email, vehicleNumber, serviceType, specialInstructions, paymentOption, date, time) {
        // Send an AJAX request to cancel the booking
        $.ajax({
            url: 'ajaxEmployee.php',
            type: 'POST',
            data: {
                'request': 'cancelBooking',
                bookingId: bookingId,
                email: email,
                vehicleNumber: vehicleNumber,
                serviceType: serviceType,
                specialInstructions: specialInstructions,
                paymentOption: paymentOption,
                date: date,
                time: time
            },
            success: function(data) {
                console.log(data);
                // Handle the success response here
                console.log('Booking Canceled:', bookingId);
                // You can update the UI or perform any other actions as needed
                loadBookingData();
            },
            error: function(error) {
                // Handle the error response here
                console.error('Error canceling booking:', error);
            }
        });
    }
</script>