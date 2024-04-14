<?php
include("dbConnection.php");
session_start();

if (isset($_SESSION["username"])) {
    $username = $_SESSION["username"];

    if ($username == "manager") {
        // Redirect to manager page
        header("Location: managerModifyBookingForm.php");
        exit();
    } elseif ($username == "employee") {
        // Redirect to employee page
        header("Location: employeeBookingPage.php");
        exit();
    } else {
        // If username is not set, or any other condition, redirect to index page
        header("Location: index.php");
        exit();
    }
} 
?>

<!DOCtype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login</title>
        <link rel="icon" type="image/x-icon" href="image\car-wash.png">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"> 
        
        <!-- CSS Libraries -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="lib/flaticon/font/flaticon.css" rel="stylesheet">
        <link href="lib/animate/animate.min.css" rel="stylesheet">
        <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="style.css" rel="stylesheet">
    </head>

    <body>
        <div class="container" id="container">
            <div class="form-container sign-in-container">
                <form action="process_loginAdmin.php" method="POST">
                    
                    <h1 style="color: #304FFE;"><img src="image/admin.png" alt="admin symbol" style="width:100%; max-width:30px; height:auto; margin-right:20px; margin-bottom:8px;">Admin Login</h1>
                    <input type="text" placeholder="Username" name="username" />
                    <input type="password" placeholder="Password" name="password" />
                    <a href="forgotAdmin.php">Forgot your password?</a>
                    <div class="btn-group" style="width:100%">
                    <button style="width:50%; margin-right: 10px;" type="submit" name="role" value="employee">Employee</button>
                    <button style="width:50%" type="submit" name="role" value="manager">Manager</button>
                    </div>
                    <p>Log In as <span><a href="login.php">Customer</a></span><p></p>
                </form>
            </div>
            <div class="overlay-container" >
                <div class="overlay" >
                    <div class="overlay-panel overlay-right" style="background-color: #5972FE;">
                        <h1>Hello!</h1>
                        <p>Enter your login details to manage bookings</p>
                        <p>
                        <a href="index.php" class="btn btn-primary w-100">Back Home</a>
                    </div>
                </div>
            </div>
        </div>

<script>
const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');

signUpButton.addEventListener('click', () => {
    container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
    container.classList.remove("right-panel-active");
    validatesignIn();
});

function validatesignIn() {
    // Perform client-side validation
    var username = document.getElementsByName('username')[0].value;
    var password = document.getElementsByName('password')[0].value;

    console.log('Username:', username);
    console.log('Password:', password);

    // For demonstration purposes, check if username and password are not empty
    if (username !== '' && password !== '') {
     // Redirect to the desired page (replace 'index.php' with your actual login page)
         window.location.href = 'index.php';
            } else {
                alert('Please enter both username and password.');
            }
        }

function myFunction() {
    // Your code for handling the dashboard display or other actions after a successful login
    console.log('Successful login! Redirecting to the dashboard...');
    window.location.href = 'dashboard1.php';
}

</script>
    </body>
</html>