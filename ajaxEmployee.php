<?php
include("dbConnection.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['request'] == 'loadBookingData') {
        loadBookingData($conn);
    }

    if ($_POST['request'] == 'approveBooking') {
        $bookingId = $_POST['bookingId'];
        $email = $_POST['email'];
        $vehicleNumber = $_POST['vehicleNumber'];
        $serviceType = $_POST['serviceType'];
        $specialInstructions = $_POST['specialInstructions'];
        $paymentOption = $_POST['paymentOption'];
        $date = $_POST['date'];
        $time = $_POST['time'];
        approveBooking($conn, $bookingId, $email, $vehicleNumber, $serviceType, $specialInstructions, $paymentOption, $date, $time);
    }

    if ($_POST['request'] == 'cancelBooking') {
        $bookingId = $_POST['bookingId'];
        $email = $_POST['email'];
        $vehicleNumber = $_POST['vehicleNumber'];
        $serviceType = $_POST['serviceType'];
        $specialInstructions = $_POST['specialInstructions'];
        $paymentOption = $_POST['paymentOption'];
        $date = $_POST['date'];
        $time = $_POST['time'];
        cancelBooking($conn, $bookingId, $email, $vehicleNumber, $serviceType, $specialInstructions, $paymentOption, $date, $time);
    }

    if ($_POST['request'] == 'loadBookingHistory') {
        loadBookingHistory($conn);
    }

    if ($_POST['request'] == 'viewBooking') {
        $bookingId = $_POST['bookingId'];
        viewBooking($conn, $bookingId);
    }
}

function loadBookingData($conn)
{
    $sql = "SELECT booking.id AS booking_id, customer.id AS customer_id,booking.*, customer.*
            FROM booking
            INNER JOIN customer ON booking.customer_id = customer.id
            WHERE bookingStatus = 'PENDING'
            ORDER BY booking.id DESC";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: employeeBookingPage.php?error=stmtfailed");
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

function approveBooking($conn, $bookingId, $email, $vehicleNumber, $serviceType, $specialInstructions, $paymentOption, $date, $time)
{
    $sql = "UPDATE booking
            SET bookingStatus = 'Approved'
            WHERE id = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $bookingId);

    if ($stmt->execute()) {
        // Query executed successfully
        echo "Booking status Approved successfully.";
        require 'phpmailer/src/Exception.php';
        require 'phpmailer/src/PHPMailer.php';
        require 'phpmailer/src/SMTP.php';

        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'taco0267@gmail.com'; // Replace with your Gmail username
        $mail->Password = 'oozn lpxj obyw isab'; // Replace with your Gmail App Password
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('taco0267@gmail.com'); // Replace with your Gmail email
        $mail->addAddress($_POST["email"]);
        $mail->isHTML(true);

        // Subject of the email
        $mail->Subject = "Booking Approved";

        // Construct the body of the email
        $body = "Dear Customer,<br><br>";
        $body .= "Your booking has been approved with the following details:<br><br>";
        $body .= "Vehicle Number: " . $_POST["vehicleNumber"] . "<br>";
        $body .= "Service Type: " . $_POST["serviceType"] . "<br>";
        $body .= "Special Instructions: " . $_POST["specialInstructions"] . "<br>";
        $body .= "Payment Option: " . $_POST["paymentOption"] . "<br>";
        $body .= "Date: " . $_POST["date"] . "<br>";
        $body .= "Time: " . $_POST["time"] . "<br><br>";
        $body .= "Thank you for choosing our service!<br><br>";
        $body .= "Best regards,<br>Taxes City CarSpa"; // Replace with your company name

        $mail->Body = $body;

        // Send the email
        $mail->send();
    } else {
        // Query failed
        echo "Error updating booking status: " . mysqli_error($conn);
    }
}

function cancelBooking($conn, $bookingId, $email, $vehicleNumber, $serviceType, $specialInstructions, $paymentOption, $date, $time)
{
    $sql = "UPDATE booking
            SET bookingStatus = 'Cancelled'
            WHERE id = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $bookingId);

    if ($stmt->execute()) {
        // Query executed successfully
        echo "Booking status Cancelled successfully.";
        require 'phpmailer/src/Exception.php';
        require 'phpmailer/src/PHPMailer.php';
        require 'phpmailer/src/SMTP.php';

        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'taco0267@gmail.com'; // Replace with your Gmail username
        $mail->Password = 'oozn lpxj obyw isab'; // Replace with your Gmail App Password
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('taco0267@gmail.com'); // Replace with your Gmail email
        $mail->addAddress($_POST["email"]);
        $mail->isHTML(true);

        // Subject of the email for booking cancellation
        $mail->Subject = "Booking Canceled";

        // Construct the body of the email
        $body = "Dear Customer,<br><br>";
        $body .= "We regret to inform you that your booking has been canceled with the following details:<br><br>";
        $body .= "Vehicle Number: " . $_POST["vehicleNumber"] . "<br>";
        $body .= "Service Type: " . $_POST["serviceType"] . "<br>";
        $body .= "Special Instructions: " . $_POST["specialInstructions"] . "<br>";
        $body .= "Payment Option: " . $_POST["paymentOption"] . "<br>";
        $body .= "Date: " . $_POST["date"] . "<br>";
        $body .= "Time: " . $_POST["time"] . "<br><br>";
        $body .= "If you have any questions or concerns, please feel free to contact us.<br><br>";
        $body .= "We apologize for any inconvenience caused.<br><br>";
        $body .= "Best regards,<br>AF CAR WASH"; // Replace with your company name

        $mail->Body = $body;

        // Send the email
        $mail->send();
    } else {
        // Query failed
        echo "Error updating booking status: " . mysqli_error($conn);
    }
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
        header("Location: employeeBookingHistory.php?error=stmtfailed");
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
        header("Location: employeeBookingHistory.php?error=stmtfailed");
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


