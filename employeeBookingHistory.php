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
    <title>Employee Booking History</title>
    <link rel="icon" type="image/x-icon" href="image\car-wash.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <?php include 'includes/header.php'; ?>
</head>

<body>
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

                        <a href="employeeBookingPage.php" class="nav-item nav-link">Pending Booking</a>
                        <a href="employeeBookingHistory.php" class="nav-item nav-link active">Booking History</a>
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

    <!-- Main Content Container -->
    <div class="container mt-4">
        <h2>Booking History</h2>
        <!-- Search Bar -->
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Search..." id="searchInput">
        </div>

        <div class="table-responsive mt-4">
            <table class="table table-bordered table-hover" id="bookingTable">
                <thead class="thead-light">
                    <tr>
                        <th>Scheduled Date</th>
                        <th>Booking Id</th>
                        <th>Service Type</th>
                        <th>Car Type</th>
                        <th>Time</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Table Updated Using JQuery Ajax -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="bookingDetailsModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><strong>Customer name: </strong><span id="customerUsername"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Add booking details here -->
                    <ul>
                        <li><strong>Booking ID:</strong> <span id="bookingId"></span></li>
                        <li><strong>Phone Number:</strong> <span id="phoneNumber"></span></li>
                        <li><strong>Vehicle Number:</strong> <span id="vehicleNumber"></span></li>
                        <li><strong>Car Type:</strong> <span id="carType"></span></li>
                        <li><strong>Special Instruction (If Any):</strong> <span id="specialInstruction"></span></li>
                        <li><strong>Type of Service:</strong> <span id="serviceType"></span></li>
                        <li><strong>Scheduled Date:</strong> <span id="scheduledDate"></span></li>
                        <li><strong>Scheduled Time:</strong> <span id="scheduledTime"></span></li>
                        <li><strong>Type of Service:</strong> <span id="paymentOption"></span></li>
                        <li><strong>Status:</strong> <span id="status"></span></li>
                        <li><strong>Cost:</strong> <span id="cost"></span></li>
                        <li><strong>Payment Status:</strong> <span id="paymentStatus"></span></li>
                        <li><strong>Invoice Number (If Payment Done):</strong> <span id="invoiceNumber"></span></li>
                        <li><strong>Receipt Number (If Payment Done):</strong> <span id="receiptNumber"></span></li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS, Popper.js and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-c1tAAjOQppz6v8r7Fm5Vv9aDHF49/rvx8+ayyJ99KOTdeM4gdeq5g7yPVNVnpq0Q"
        crossorigin="anonymous"></script>
</body>

</html>

<!-- JavaScript code -->
<script>
    $(document).ready(function () {
        // Load initial booking data when the page loads
        loadBookingHistory();
        // Search functionality using jQuery
        $('#searchInput').on('keyup', function () {
            const value = $(this).val().toLowerCase();
            $("#bookingTable tbody tr").filter(function () {
                let rowText = '';
                $(this).find('td').each(function () { // Iterate through all columns
                    rowText += $(this).text().toLowerCase() + ' ';
                });
                $(this).toggle(rowText.includes(value));
            });
        });
    });

    function loadBookingHistory() {
        // Send an AJAX request to fetch updated booking data
        $.ajax({
            url: 'ajaxEmployee.php',
            type: 'POST',
            data: {
                'request': 'loadBookingHistory',
            },
            dataType: 'json',
            success: function (data) {
                // Handle the success response here
                updateTable(data);
            },
            error: function (error) {
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
                '<td>' + row['date'] + '</td>' +
                '<td>' + row['booking_id'] + '</td>' +
                '<td>' + row['serviceType'] + '</td>' +
                '<td>' + row['carType'] + '</td>' +
                '<td>' + row['time'] + '</td>' +
                '<td>' + row['paymentOption'] + '</td>' +
                '<td>' + row['bookingStatus'] + '</td>' + // Display bookingStatus from data
                '<td>' +
                '<button class="btn btn-secondary" onclick="viewBooking(\'' + row['booking_id'] + '\')">View Details</button>' +
                '</td>');
        });
    }

    function viewBooking(bookingId) {
        console.log('BookingId: ', bookingId);
        // Send an AJAX request to fetch booking details based on the bookingId
        $.ajax({
            url: 'ajaxEmployee.php',
            type: 'POST',
            data: {
                'request': 'viewBooking',
                'bookingId': bookingId
            },
            dataType: 'json',
            success: function (data) {
                console.log('data: ', data);
                // Populate the modal with the fetched data
                $('#customerUsername').text(data.username);
                $('#bookingId').text(data.booking_id);
                $('#phoneNumber').text(data.phone);
                $('#vehicleNumber').text(data.vehicle);
                $('#carType').text(data.carType);
                $('#specialInstruction').text(data.special);
                $('#serviceType').text(data.serviceType);
                $('#scheduledDate').text(data.date);
                $('#scheduledTime').text(data.time);
                $('#paymentOption').text(data.paymentOption);
                $('#status').text(data.bookingStatus);
                $('#cost').text(data.cost);
                $('#paymentStatus').text(data.paymentStatus);
                $('#invoiceNumber').text(data.invoiceNumber);
                $('#receiptNumber').text(data.receiptNumber);

                // Open the modal
                $('#bookingDetailsModal').modal('show');
            },
            error: function (error) {
                // Handle the error response here
                console.error('Error fetching booking details:', error);
            }
        });
    }
</script>