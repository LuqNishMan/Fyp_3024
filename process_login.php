<?php session_start();
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assuming you have a database connection code here
    include_once 'dbConnection.php';

    // Get username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query the database to check the credentials
    $sql = "SELECT * FROM customer WHERE username= '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $retrievedPassword = $row['password'];
        $id = $row['id'];

        // Verify the entered password
        if ($password == $retrievedPassword) {
            // Successful login
            echo json_encode(['status' => 'success', 'message' => 'Login successful']);
            // Set session variables on successful login
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['id'] = $id;
            header("location: index.php");
        } else {
            // Incorrect password
            echo json_encode(['status' => 'error', 'message' => 'Incorrect password']);
            header("location: login.php");
        }
    } else {
        // User not found
        echo json_encode(['status' => 'error', 'message' => 'User not found']);
        header("location: login.php");
    }

    $conn->close();
} else {
    // If the form is not submitted, return an error
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}
