<?php
include("dbConnection.php");
session_start();

if (isset($_SESSION["username"]) && $_SESSION["username"] == "manager") {
    // Code for manager access
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
    <title>Manager Booking History</title>
    <link rel="icon" type="image/x-icon" href="image\car-wash.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">

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

                        <a href="managerModifyBookingForm.php" class="nav-item nav-link">Modify Booking</a>
                        <a href="managerBookingHistory.php" class="nav-item nav-link active">Booking History</a>
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
        <div class="row">
            <h2>Booking History</h2>
            <!-- Search Bar -->
            <div class="col-sm-10"> <!-- Adjust the width as needed -->
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search..." id="searchInput">
                </div>
            </div>
            <div class="col text-right">
                <button class="btn btn-primary" type="button" onclick="addbooking()">
                    <i class="fa-regular fa-calendar-plus mr-1"></i> Add Booking
                </button>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="addBookingModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><strong>Add New Booking</strong></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Booking Form Start -->
                        <div class="container mt-8">
                            <div class="booking-form">
                                <form id="carWashForm">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="addTelephoneNumber">Telephone Number:</label>
                                            <input type="text" class="form-control" id="addTelephoneNumber"
                                                name="addTelephoneNumber">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="addServiceType">Select Service Type:</label>
                                            <select class="form-select" id="addServiceType" name="addServiceType">
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
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="addVehicleNumber">Vehicle Number:</label>
                                            <input type="text" class="form-control" id="addVehicleNumber"
                                                name="addVehicleNumber">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="addBookingDate">Select Date:</label>
                                            <input type="date" class="form-control" id="addBookingDate"
                                                name="addBookingDate">
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="addCarType">Select Car Type:</label>
                                            <select class="form-select" id="addCarType" name="addCarType">
                                                <option value="" disabled selected>Please Choose</option>
                                                <option value="smallCar">Small Car</option>
                                                <option value="SUV">SUV</option>
                                                <option value="van">Van</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="addBookingTime">Select Time:</label>
                                            <select class="form-select" id="addBookingTime" name="addBookingTime">
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
                                    </div>

                                    <div class="form-group">
                                        <label for="addSpecialInstructions">Special Instructions (If Any):</label>
                                        <textarea class="form-control" id="addSpecialInstructions"
                                            name="addSpecialInstructions" rows="3"></textarea>
                                    </div>

                                    <div class="form-group col-md-6">
                                            <label for="addPaymentOption">Select Payment Option:</label>
                                            <select class="form-select" id="addPaymentOption" name="addPaymentOption">
                                                <option value="" disabled selected>Please Choose</option>
                                                <option value="online">Online</option>
                                                <option value="offline">Offline</option>
                                            </select>
                                        </div>
                                </form>
                                <div id="error-message" class="error-message"></div>
                            </div>
                        </div>
                        <!-- Booking Form End -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" onclick="validateBooking()">Save Booking</button>
                    </div>
                </div>
            </div>
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
                    <h5 class="modal-title" id="exampleModalLabel"><strong>Customer name: </strong><span
                            id="customerUsername"></span></h5>
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
                        <li><strong>Payment Option:</strong> <span id="paymentOption"></span></li>
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
    //MODAL FORM FOR ADD BOOKING
    function validateBooking() {
        // Get form elements
        var serviceType = document.getElementById("addServiceType").value;
        var carType = document.getElementById("addCarType").value;
        var bookingDate = document.getElementById("addBookingDate").value;
        var bookingTime = document.getElementById("addBookingTime").value;
        var paymentOption = document.getElementById("addPaymentOption").value;
        var telephoneNumber = document.getElementById("addTelephoneNumber").value;
        var vehicleNumber = document.getElementById("addVehicleNumber").value;
        var specialInstructions = document.getElementById("addSpecialInstructions").value;

        // Validate form inputs
        if (
            addServiceType === "" ||
            addCarType === "" ||
            addBookingDate === "" ||
            addBookingTime === "" ||
            addPaymentOption === "" ||
            addTelephoneNumber === "" ||
            addVehicleNumber === ""
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
                saveBooking();
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

    $(document).ready(function () {
        // Load initial booking data when the page loads
        loadBookingHistory();
        clearFormFields();

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

    //LOAD BOOKING HISTORY FUNCTION
    function loadBookingHistory() {
        // Send an AJAX request to fetch updated booking data
        $.ajax({
            url: 'ajaxManager.php',
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

    //VIEW DETAILS BUTTON FUNCTION
    function viewBooking(bookingId) {
        console.log('BookingId: ', bookingId);
        // Send an AJAX request to fetch booking details based on the bookingId
        $.ajax({
            url: 'ajaxManager.php',
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

    function addbooking() {
        $('#addBookingModal').modal('show');
    };

    function saveBooking() {
        // Get the values of the selected options
        var serviceType = $('#addServiceType').val();
        var carType = $('#addCarType').val();
        var bookingDate = $('#addBookingDate').val();
        var bookingTime = $('#addBookingTime').val();
        var paymentOption = $('#addPaymentOption').val();

        // Send an AJAX request to save the booking data
        $.ajax({
            url: 'ajaxManager.php',
            type: 'POST',
            data: {
                'request': 'saveBooking',
                serviceType: serviceType,
                carType: carType,
                bookingDate: bookingDate,
                bookingTime: bookingTime,
                telephoneNumber: $('#addTelephoneNumber').val(),
                vehicleNumber: $('#addVehicleNumber').val(),
                specialInstructions: $('#addSpecialInstructions').val()
                paymentOption: paymentOption,
            },
            success: function (data) {
                // Handle the success response here
                console.log('Booking saved successfully:', data);

                // Close the modal after successful booking
                $('#addBookingModal').modal('hide');

                // Clear the form fields
                clearFormFields();

                // Display a SweetAlert2 confirmation message with service type, car type, date, and time
                Swal.fire({
                    icon: 'success',
                    title: 'Booking Saved',
                    html: `Service Type: ${serviceType}<br>Car Type: ${carType}<br>Date: ${bookingDate}<br>Time: ${bookingTime}<br>Payment Option: ${paymentOption}`,
                    showConfirmButton: false,
                    // timer: 10000 // Automatically close after 10 seconds
                });

                // Optionally, you can reload the booking history to update the table
                loadBookingHistory();
            },
            error: function (error) {
                // Handle the error response here
                console.error('Error saving booking:', error);
            }
        });
    }


    function clearFormFields() {
        // Reset the form fields to their default values or empty
        $('#addServiceType').val('');
        $('#addCarType').val('');
        $('#addBookingDate').val('');
        $('#addBookingTime').val('');
        $('#addTelephoneNumber').val('');
        $('#addVehicleNumber').val('');
        $('#addSpecialInstructions').val('');
        $('#addPaymentOption').val('');
    }
</script>