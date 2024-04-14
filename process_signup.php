<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include_once 'dbConnection.php';

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate inputs
    if (empty($username) || empty($email) || empty($password)) {
        header("Location: login.php?error=emptyfields");
        exit();
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: login.php?error=invalidemail");
        exit();
    }

    // Check if username or email exists
    $usernameExists = usernameExists($conn, $username, $email);
    
    if (!$usernameExists) {
        createCustomer($conn, $username, $email, $password);
    } else {
        header("Location: login.php?error=userexists");
        exit();
    }
}

//Prevent username and email duplicate
function usernameExists($conn, $username, $email) {
    $sql = "SELECT username FROM customer WHERE username = ? OR email = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: login.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        mysqli_stmt_close($stmt);
        return true;
    } else {
        mysqli_stmt_close($stmt);
        return false;
    }
}

function createCustomer($conn, $username, $email, $password) {
    $sql = "INSERT INTO customer (username, email, password) VALUES (?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: login.php?error=stmtfailed");
        exit();    
    }

    mysqli_stmt_bind_param($stmt, "sss", $username, $email, $password);

    if (mysqli_stmt_execute($stmt)) {
        echo "New record created successfully";
        header("location: login.php");
        exit();
    } else {
        echo "Error: " . mysqli_stmt_error($stmt);
        header("location: login.php");
        exit();
    }
}
