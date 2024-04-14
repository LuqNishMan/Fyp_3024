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
    <title>Manager Modify Booking Form</title>
    <link rel="icon" type="image/x-icon" href="image\car-wash.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

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

                        <a href="managerModifyBookingForm.php" class="nav-item nav-link active">Modify Booking</a>
                        <a href="managerBookingHistory.php" class="nav-item nav-link">Booking History</a>
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

    <div class="container mt-4">
        <h2>Modify Booking</h2>
        <!-- Search Bar -->
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Search..." id="searchInput">
        </div>
        <div class=" table-responsive mt-4">
            <table class="table table-bordered table-hover" id="bookingTable">
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

                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="editBookingModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><strong>Edit Booking</strong><span
                            id="customerUsername"></span></h5>
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
                                        <label for="telephoneNumber">Telephone Number:</label>
                                        <input type="text" class="form-control" id="telephoneNumber"
                                            name="telephoneNumber">
                                    </div>

                                    <div class="form-group col-md-6">
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
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="vehicleNumber">Vehicle Number:</label>
                                        <input type="text" class="form-control" id="vehicleNumber" name="vehicleNumber">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="bookingDate">Select Date:</label>
                                        <input type="date" class="form-control" id="bookingDate" name="bookingDate">
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="carType">Select Car Type:</label>
                                        <select class="form-select" id="carType" name="carType">
                                            <option value="" disabled selected>Please Choose</option>
                                            <option value="smallCar">Small Car</option>
                                            <option value="SUV">SUV</option>
                                            <option value="van">Van</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
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
                                </div>

                                <div class="form-group">
                                    <label for="specialInstructions">Special Instructions (If Any):</label>
                                    <textarea class="form-control" id="specialInstructions" name="specialInstructions"
                                        rows="3"></textarea>
                                </div>

                                <div class="form-group col-md-6">
                                        <label for="paymentOption">Select Payment Option:</label>
                                        <select class="form-select" id="paymentOption" name="paymentOption">
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

    <!-- Bootstrap JS, Popper.js and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-c1tAAjOQppz6v8r7Fm5Vv9aDHF49/rvx8+ayyJ99KOTdeM4gdeq5g7yPVNVnpq0Q"
        crossorigin="anonymous"></script>
    <!-- JS PDF -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.debug.js"></script>
</body>

</html>

<script>
    $(document).ready(function () {
        // Load initial booking data when the page loads
        loadBookingData();
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

    function loadBookingData() {
        // Send an AJAX request to fetch updated booking data
        $.ajax({
            url: 'ajaxManager.php',
            type: 'POST',
            data: {
                'request': 'loadBookingData',
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
                '<td>' + row['booking_id'] + '</td>' +
                '<td>' + row['username'] + '</td>' +
                '<td>' + row['email'] + '</td>' +
                '<td>' + row['date'] + '</td>' +
                '<td>' + row['time'] + '</td>' +
                '<td>' + row['bookingStatus'] + '</td>' + // Display bookingStatus from data
                '<td>' +
                '<button class="btn btn-primary ml-1" onclick="editBookingModal(' +
                '\'' + row['booking_id'] + '\',' +
                '\'' + row['serviceType'] + '\',' +
                '\'' + row['carType'] + '\',' +
                '\'' + row['date'] + '\',' +
                '\'' + row['time'] + '\',' +
                '\'' + row['phone'] + '\',' +
                '\'' + row['vehicle'] + '\',' +
                '\'' + row['special'] + '\',' +
                '\'' + row['paymentOption'] + '\',' +
                '\'' + row['cost'] + '\',' +
                '\'' + row['invoiceNumber'] + '\',' +
                '\'' + row['paymentStatus'] + '\',' +
                '\'' + row['receiptNumber'] + '\'' +
                ')">Edit</button>' +
                '<button class="btn btn-danger ml-1" onclick="deleteBooking(\'' + row['booking_id'] + '\')">Delete</button>' +
                '<button class="btn btn-secondary ml-1" onclick="downloadBooking(' +
                '\'' + row['username'] + '\',' +
                '\'' + row['booking_id'] + '\',' +
                '\'' + row['serviceType'] + '\',' +
                '\'' + row['carType'] + '\',' +
                '\'' + row['date'] + '\',' +
                '\'' + row['time'] + '\',' +
                '\'' + row['phone'] + '\',' +
                '\'' + row['vehicle'] + '\',' +
                '\'' + row['special'] + '\',' +
                '\'' + row['paymentOption'] + '\',' +
                '\'' + row['cost'] + '\',' +
                '\'' + row['invoiceNumber'] + '\',' +
                '\'' + row['paymentStatus'] + '\',' +
                '\'' + row['receiptNumber'] + '\'' +
                ')">Download</button>' +
                '</td>' +
                '</tr>');
        });
    }

    function editBookingModal(bookingId, serviceType, carType, bookingDate, bookingTime, telephoneNumber, vehicleNumber, specialInstructions, paymentOption, cost, invoiceNumber, paymentStatus, receiptNumber) {
        // You can add logic here to handle editing of the booking
        console.log('Edit Booking:', bookingId, serviceType, carType, bookingDate, bookingTime, telephoneNumber, vehicleNumber, specialInstructions, paymentOption);
        // Prepopulate the form fields with the booking data
        $('#serviceType').val(serviceType);
        $('#carType').val(carType);
        $('#bookingDate').val(bookingDate);
        $('#bookingTime').val(convertTo12HourFormat(bookingTime));
        $('#telephoneNumber').val(telephoneNumber);
        $('#vehicleNumber').val(vehicleNumber);
        $('#specialInstructions').val(specialInstructions);
        $('#paymentOption').val(paymentOption);
        $('#cost').val(cost);
        $('#invoiceNumber').val(invoiceNumber);
        $('#paymentStatus').val(paymentStatus);
        $('#receiptNumber').val(receiptNumber);

        // Define a closure to capture the bookingId
        function saveBookingClosure() {
            // Pass the bookingId to the editBooking function
            editBooking(bookingId);
        }

        // Attach the click event handler to the "Save Booking" button
        $('#editBookingModal').find('.btn-primary').off('click').on('click', saveBookingClosure);

        //Show editBookingModal
        $('#editBookingModal').modal('show');
    }

    function convertTo12HourFormat(time) {
        var parts = time.split(':');
        var hours = parseInt(parts[0]);
        var minutes = parts[1];

        var ampm = hours >= 12 ? 'PM' : 'AM';

        // Adjust hours for 12-hour format
        if (hours > 12) {
            // No need to adjust if it's already greater than 12
            formattedTime = hours + ':' + minutes + ' ' + ampm;
        } else if (hours === 0) {
            hours = 12; // Handle midnight
            formattedTime = hours + ':' + minutes + ' ' + ampm;
        } else {
            formattedTime = hours + ':' + minutes + ' ' + ampm;
        }

        return formattedTime;
    }

    function validateBooking() {
        // Get form elements
        var serviceType = $('#serviceType').val();
        var carType = $('#carType').val();
        var bookingDate = $('#bookingDate').val();
        var bookingTime = $('#bookingTime').val();
        var telephoneNumber = $('#telephoneNumber').val();
        var vehicleNumber = $('#vehicleNumber').val();
        var specialInstructions = $('#specialInstructions').val();
        var paymentOption = $('#paymentOption').val();
        var cost = $('#cost').val();
        var invoiceNumber = $('#invoiceNumber').val();
        var paymentStatus = $('#paymentStatus').val();
        var receiptNumber = $('#receiptNumber').val();

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
            $('#error-message').html("");

            // Determine price based on car type
            var priceRange = getPriceRange(carType);

            // Validate time range (8 am to 6 pm)
            var selectedHour = parseInt(bookingTime.split(":")[0]);
            var selectedMinutes = parseInt(bookingTime.split(":")[1]);

            if (
                (selectedHour > 8 || (selectedHour === 8 && selectedMinutes >= 0)) &&
                (selectedHour < 18 || (selectedHour === 18 && selectedMinutes <= 0))
            ) {
                // editBooking();
            } else {
                alert("Please select a time between 8 am and 6 pm.");
            }
        }
    }

    function editBooking(bookingId) {
        // Get the values of the selected options
        var serviceType = $('#serviceType').val();
        var carType = $('#carType').val();
        var bookingDate = $('#bookingDate').val();
        var bookingTime = $('#bookingTime').val();
        var telephoneNumber = $('#telephoneNumber').val();
        var vehicleNumber = $('#vehicleNumber').val();
        var specialInstructions = $('#specialInstructions').val();
        var paymentOption = $('#paymentOption').val();
        var cost = $('#cost').val();
        var invoiceNumber = $('#invoiceNumber').val();
        var paymentStatus = $('#paymentStatus').val();
        var receiptNumber = $('#receiptNumber').val();
        console.log(cost, invoiceNumber, paymentStatus, receiptNumber);

        // Send an AJAX request to save the booking data
        $.ajax({
            url: 'ajaxManager.php',
            type: 'POST',
            data: {
                'request': 'editBooking',
                bookingId: bookingId,
                telephoneNumber: telephoneNumber,
                vehicleNumber: vehicleNumber,
                serviceType: serviceType,
                carType: carType,
                bookingDate: bookingDate,
                bookingTime: bookingTime,
                specialInstructions: specialInstructions,
                paymentOption: paymentOption,
                cost: cost,
                invoiceNumber: invoiceNumber,
                paymentStatus: paymentStatus,
                receiptNumber: receiptNumber
            },
            success: function (data) {
                // Handle the success response here
                console.log('Booking saved successfully:', data);

                // Close the modal after successful booking
                $('#editBookingModal').modal('hide');

                // Clear the form fields
                clearFormFields();

                // Display a SweetAlert2 confirmation message with all the details
                Swal.fire({
                    icon: 'success',
                    title: 'Booking Edited',
                    html: ` Booking Id: ${bookingId}<br>
                            Service Type: ${serviceType}<br>
                            Car Type: ${carType}<br>
                            Date: ${bookingDate}<br>
                            Time: ${bookingTime}<br>
                            Telephone Number: ${telephoneNumber}<br>
                            Vehicle Number: ${vehicleNumber}<br>
                            Special Instructions: ${specialInstructions}<br>
                            Payment Option: ${paymentOption}<br>
                            Cost: ${cost}<br>
                            Invoice Number: ${invoiceNumber}<br>
                            Payment Status: ${paymentStatus}<br>
                            Receipt Number: ${receiptNumber}`,
                    showConfirmButton: false,
                    // timer: 10000 // Automatically close after 10 seconds
                });
            },
            error: function (error) {
                // Handle the error response here
                console.error('Error saving booking:', error);
            }
        });
    }

    function clearFormFields() {
        // Reset the form fields to their default values or empty
        $('#serviceType').val('');
        $('#carType').val('');
        $('#bookingDate').val('');
        $('#bookingTime').val('');
        $('#telephoneNumber').val('');
        $('#vehicleNumber').val('');
        $('#specialInstructions').val('');
        $('#paymentOption').val('');
        $('#cost').val('');
        $('#invoiceNumber').val('');
        $('#paymentStatus').val('');
        $('#receiptNumber').val('');
    }

    function deleteBooking(bookingId) {
        // Show a confirmation dialog using SweetAlert
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                // User confirmed the deletion, proceed with the deletion
                // Send an AJAX request to delete the booking
                $.ajax({
                    url: 'ajaxManager.php',
                    type: 'POST',
                    data: {
                        'request': 'deleteBooking',
                        bookingId: bookingId
                    },
                    success: function (data) {
                        console.log(data);
                        // Handle the success response here
                        console.log('Booking Deleted:', bookingId);
                        // You can update the UI or perform any other actions as needed
                        loadBookingData();
                        // Show a success dialog using SweetAlert
                        Swal.fire({
                            title: "Deleted!",
                            text: "Your booking has been deleted.",
                            icon: "success"
                        });
                    },
                    error: function (error) {
                        // Handle the error response here
                        console.error('Error deleting booking:', error);
                    }
                });
            }
        });
    }

    function downloadBooking(
        username,
        bookingId,
        serviceType,
        carType,
        bookingDate,
        bookingTime,
        telephoneNumber,
        vehicleNumber,
        specialInstructions,
        paymentOption
    ) {
        var doc = new jsPDF('landscape');

    // Add a company logo - replace 'logo.jpg' with the path to your logo image
    // doc.addImage('image/logo.jpg', 'png', 10, 10, 50, 20);

    // Title
    doc.setFontSize(22);
    // doc.setFont("Helvetica", "bold");
    doc.text("Booking Receipt", 120, 15); // Centered title in landscape

    // Customer Information
    doc.setFontSize(12);
    // doc.setFont("Helvetica", "normal");
    doc.text(`Name: ${username}`, 120, 25);

    // Line separator
    doc.setLineWidth(0.2);
    doc.line(10, 45, 280, 45);

    // Booking Details - consider using doc.autoTable if available for tabular data
    var startY = 60;
    var details = [
        // `Customer Username: ${username}`,
        `Booking ID: ${bookingId}`,
        `Service Type: ${serviceType}`,
        `Car Type: ${carType}`,
        `Booking Date: ${bookingDate}`,
        `Booking Time: ${bookingTime}`,
        `Telephone Number: ${telephoneNumber}`,
        `Vehicle Number: ${vehicleNumber}`,
        `Special Instructions: ${specialInstructions}`,
        `Payment Option: ${paymentOption}`
    ];
    doc.setFontSize(12);
    details.forEach((detail, i) => {
        doc.text(detail, 10, startY + (i * 10));
    });

    // Footer
    doc.setFontSize(10);
    doc.text("Thank you for choosing our service!", 10, 190);
    doc.text("Contact us: [Your Contact Details]", 10, 200);

    // Save the PDF
    doc.save(`booking_${bookingId}.pdf`);
        console.log('Booking Downloaded:', bookingId, serviceType, carType, bookingDate, bookingTime, telephoneNumber, vehicleNumber, specialInstructions, paymentOption);
        alert('Booking downloaded');
    }
</script>

