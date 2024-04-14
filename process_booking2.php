<?php session_start();
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assuming you have a database connection code here
    include_once 'dbConnection.php';

    // Check if the required fields are set
    if (isset($_POST['telephoneNumber'], $_POST['vehicleNumber'], $_POST['serviceType'], $_POST['carType'], $_POST['bookingDate'], $_POST['bookingTime'], $_POST['paymentOption'])) 
    {
        $telephoneNumber = $_POST['telephoneNumber'];
        $vehicleNumber = $_POST['vehicleNumber'];
        $serviceType = $_POST['serviceType'];
        $carType = $_POST['carType'];
        $bookingDate = $_POST['bookingDate'];
        $bookingTime = $_POST['bookingTime'];
        $specialInstructions = isset($_POST['specialInstructions']) ? $_POST['specialInstructions'] : '';
        $paymentOption = $_POST['paymentOption'];

        $id = $_SESSION['id'];
        $_SESSION['serviceType'] = $serviceType;
        $_SESSION['carType'] = $carType;
        $_SESSION['bookingDate'] = $bookingDate;
        $_SESSION['bookingTime'] = $bookingTime;
        $_SESSION['paymentOption'] = $paymentOption;
       


        // Prepare SQL statement to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO booking (customer_id, phone,vehicle,serviceType,carType,date,time,special,paymentOption) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issssssss", $id, $telephoneNumber, $vehicleNumber, $serviceType, $carType, $bookingDate, $bookingTime, $specialInstructions, $paymentOption);

        // Execute the statement and check for errors
        if ($stmt->execute()) {
            echo "New record created successfully";
            header("location: bookingconfirmation1member.php");
        } else {
            echo "Failed to send " . $stmt->error;
            header("location: booking2.php");
        }

        // Close the statement
        $stmt->close();
    } else {
        // Redirect to booking2.php when required fields are missing
        header("location: booking2.php");
    }
}