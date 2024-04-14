<?php
include("dbConnection.php");
session_start();

if (isset($_SESSION["username"])) {
    // If the user is already logged in, redirect to some other page (e.g., dashboard)
    header("Location: index.php");
    exit(); // Ensure that no further code is executed after the redirect
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
            <div class="form-container sign-up-container">
                <form action="process_signup.php" method="POST" >
                    <h1 style="color: black;">Create account to stay connected!</h1>
                    <input type="text" placeholder="Name" name="username"/>
                    <input type="email" placeholder="Email" name="email" />
                    <input type="password" placeholder="Password" name="password" />
                    <button type="submit">Sign Up</button>
                </form>
            </div>
            <div class="form-container sign-in-container">
                <form action="process_login.php" method="POST">
                    <h1 style="color: black;">Welcome!</h1>
                    <input type="text" placeholder="Username" name="username" />
                    <input type="password" placeholder="Password" name="password" />
                    <a href="forgotCust.php">Forgot your password?</a>
                    <button type="submit">Login</button>
                    <p>Log In as <span><a href="loginAdmin.php">Administrator</a></span><p></p>
                </form>
            </div>
            <div class="overlay-container">
                <div class="overlay">
                    <div class="overlay-panel overlay-left">
                        <h1>Welcome Back!</h1>
                        <p>To keep connected with us please login with your personal info</p>
                        <button class="ghost" id="signIn">Login</button>
                        <p>
                        <a href="index.php" class="btn btn-primary W-100">Back Home</a>
                    </div>
                    <div class="overlay-panel overlay-right">
                        <h1>Hello!</h1>
                        <p>Enter your personal details and start journey with us</p>
                        <button class="ghost" id="signUp">Sign Up</button>
                        <p>
                        <a href="index.php" class="btn btn-primary W-100">Back Home</a>
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
    window.location.href = 'dashboardMember.php';
}

</script>
    </body>
</html>
