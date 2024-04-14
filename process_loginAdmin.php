<?php session_start();
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assuming you have a database connection code here
    include_once 'dbConnection.php';

    // Get username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Query the database to check the credentials
    $sql = "SELECT * FROM admin WHERE username = '$username' AND role = '$role'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $pwd = $row['password'];

        // Verify the entered password against password from database
        if ($password == $pwd) {
            // Successful login
            echo json_encode(['status' => 'success', 'message' => 'Login successful']);
            // Set session variables on successful login
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $role;

            if ($_SESSION['role'] == 'employee') {
            //go to employee page
            header("location: employeeBookingPage.php");
            }

            if ($_SESSION['role'] == 'manager') {
            //go to manager page
                header("location: managerModifyBookingForm.php");
            }
        } else {
            // Incorrect password
            echo json_encode(['status' => 'error', 'message' => 'Incorrect password']);
            header("location: loginAdmin.php");
        }
    } else {
        // User not found
        echo json_encode(['status' => 'error', 'message' => 'Admin not found']);
        header("location: loginAdmin.php");
    }

    $conn->close();
} else {
    // If the form is not submitted, return an error
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}


