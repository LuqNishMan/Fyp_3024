<?php
session_start();

if (!isset($_SESSION["username"])) {
    // If no active session, redirect to the login page
    header("Location: index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Logout</title>
    <style>
        body {
            font-family: 'Barlow', sans-serif;
            background-color: #202C45;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .logout-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        h2 {
            color: #333;
        }

        button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="logout-container">
    <h2>Are you sure you want to logout?</h2>
    <button onclick="logout()">Logout</button>
</div>

<script>
    function logout() {
        // You can add additional logout logic here, such as clearing user session
        alert('Logged out successfully!');
        <?php session_destroy(); // Destroy the session ?>
        // Redirect to the login page or any other desired page
        window.location.href = 'index.php';
    }
</script>

</body>
</html>
