<?php
include("dbConnection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['request'] == 'loadBookingData') {
        loadBookingData($conn);
    }

    if ($_POST['request'] == 'loadBookingHistory') {
        loadBookingHistory($conn);
    }

    if ($_POST['request'] == 'viewBooking') {
        $bookingId = $_POST['bookingId'];
        viewBooking($conn, $bookingId);
    }

    if ($_POST['request'] == 'saveBooking') {
        // Retrieve values from the $_POST array
        $telephoneNumber = $_POST['telephoneNumber'];
        $vehicleNumber = $_POST['vehicleNumber'];
        $serviceType = $_POST['serviceType'];
        $carType = $_POST['carType'];
        $bookingDate = $_POST['bookingDate'];
        $bookingTime = $_POST['bookingTime'];
        $specialInstructions = $_POST['specialInstructions'];
        $paymentOption = $_POST['paymentOption'];

        //MANAGER ID
        $customer_id = '7';
        saveBooking($conn, $customer_id, $telephoneNumber, $vehicleNumber, $serviceType, $carType, $bookingDate, $bookingTime, $specialInstructions, $paymentOption);
    }

    if ($_POST['request'] == 'editBooking') {
        // Retrieve values from the $_POST array
        $bookingId = $_POST['bookingId'];
        $telephoneNumber = $_POST['telephoneNumber'];
        $vehicleNumber = $_POST['vehicleNumber'];
        $serviceType = $_POST['serviceType'];
        $carType = $_POST['carType'];
        $bookingDate = $_POST['bookingDate'];
        $bookingTime = $_POST['bookingTime'];
        $specialInstructions = $_POST['specialInstructions'];
        $paymentOption = $_POST['paymentOption'];
        $cost = $_POST['cost'];
        $invoiceNumber = $_POST['invoiceNumber'];
        $paymentStatus = $_POST['paymentStatus'];
        $receiptNumber = $_POST['receiptNumber'];

        editBooking($conn, $bookingId, $telephoneNumber, $vehicleNumber, $serviceType, $carType, $bookingDate, $bookingTime, $specialInstructions, $paymentOption, $cost, $invoiceNumber, $paymentStatus, $receiptNumber);
    }

    if ($_POST['request'] == 'deleteBooking') {
        $bookingId = $_POST['bookingId'];
        deleteBooking($conn, $bookingId);
    }
}

function loadBookingData($conn)
{
    $sql = "SELECT booking.id AS booking_id, customer.id AS customer_id,booking.*, customer.*
            FROM booking
            INNER JOIN customer ON booking.customer_id = customer.id
            WHERE bookingStatus = 'Approved'
            ORDER BY booking.id DESC";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: managerModifyBookingForm.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    // Fetch the data into an array
    $data = array();
    while ($row = mysqli_fetch_assoc($resultData)) {
        $data[] = $row;
    }

    // Return the data in JSON format
    echo json_encode($data);
}

function loadBookingHistory($conn)
{
    $sql = "SELECT booking.id AS booking_id, customer.id AS customer_id,booking.*, customer.*
            FROM booking
            INNER JOIN customer ON booking.customer_id = customer.id
            WHERE bookingStatus = 'Approved' OR bookingStatus = 'Cancelled'
            ORDER BY booking.id DESC";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: managerBookingHistory.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    // Fetch the data into an array
    $data = array();
    while ($row = mysqli_fetch_assoc($resultData)) {
        $data[] = $row;
    }

    // Return the data in JSON format
    echo json_encode($data);
}

function viewBooking($conn, $bookingId)
{
    $sql = "SELECT booking.id AS booking_id, customer.id AS customer_id, booking.*, customer.*
            FROM booking
            INNER JOIN customer ON booking.customer_id = customer.id
            WHERE booking.id = ?"; // Use 'id' as the placeholder for bookingId

    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: managerBookingHistory.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "i", $bookingId);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);

    // Fetch a single row from the result
    if ($row = mysqli_fetch_assoc($resultData)) {
        // Return the single row in JSON format
        echo json_encode($row);
    } else {
        // Handle the case where no data is found
        echo json_encode(array('error' => 'No data found'));
    }
}

function saveBooking($conn, $customer_id, $telephoneNumber, $vehicleNumber, $serviceType, $carType, $bookingDate, $bookingTime, $specialInstructions, $paymentOption)
{
    // Prepare SQL statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO booking (customer_id, phone, vehicle, serviceType, carType, date, time, special, paymentOption) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssssss", $customer_id, $telephoneNumber, $vehicleNumber, $serviceType, $carType, $bookingDate, $bookingTime, $specialInstructions, $paymentOption);

    // Execute the statement and check for errors
    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Failed to send " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

function editBooking($conn, $bookingId, $telephoneNumber, $vehicleNumber, $serviceType, $carType, $bookingDate, $bookingTime, $specialInstructions, $paymentOption, $cost, $invoiceNumber, $paymentStatus, $receiptNumber) {
    // Create a prepared statement for updating data
    $stmt = $conn->prepare("UPDATE booking SET phone=?, vehicle=?, serviceType=?, carType=?, date=?, time=?, special=?, paymentOption=?, cost=?, invoiceNumber=?, paymentStatus=?, receiptNumber=? WHERE id=?");

    // Bind the parameters to the statement
    $stmt->bind_param("sssssssssssi", $telephoneNumber, $vehicleNumber, $serviceType, $carType, $bookingDate, $bookingTime, $specialInstructions, $paymentOption, $cost, $invoiceNumber, $paymentStatus, $receiptNumber, $bookingId);

    // Execute the statement and check for errors
    if ($stmt->execute()) {
        echo "Booking record updated successfully";
    } else {
        echo "Failed to update booking record: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

function deleteBooking($conn, $bookingId)
{
    // Prepare SQL statement to prevent SQL injection
    $stmt = $conn->prepare("DELETE FROM booking WHERE id = ?;");
    $stmt->bind_param("i", $bookingId);

    // Execute the statement and check for errors
    if ($stmt->execute()) {
        echo "Booking Deleted Successfully";
    } else {
        echo "Failed to Delete Booking" . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}
;
