<?php
include("dbConnection.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Load PHPMailer and its dependencies
    require_once 'phpmailer/src/Exception.php';
    require_once 'phpmailer/src/PHPMailer.php';
    require_once 'phpmailer/src/SMTP.php';

    if ($_POST['request'] == 'forgotCust') {
        $email = $_POST['email'];
        forgotCust($conn, $email);
    }

    //Admin Email is hardcoded, compare the email with the hardcoded email
    //Will return both employee and manager password
    if ($_POST['request'] == 'forgotAdmin') {
        $email = $_POST['email'];
        forgotAdmin($conn, $email);
    }


}

////////CONTINUE HERE, THEN MAKE FUNCTION IN THE FRONT PAGE THEN EDIT THE DATABASE REMOVE THE HASHED PASSWORD
function forgotCust($conn, $email)
{
    $sql = "SELECT username, password FROM customer WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $username = $row['username'];
        $password = $row['password'];

        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'zackiesie@gmail.com'; // Replace with your Gmail username
            $mail->Password = 'vtlw acyo sjee ngju'; // Replace with your Gmail App Password
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
            $mail->setFrom('zackiesie@gmail.com'); // Replace with your Gmail email
            $mail->addAddress($email);
            $mail->isHTML(true);

            // Subject of the email
            $mail->Subject = "Your Password Information";
            $mail->Body = "
                <p>Dear $username,</p>
                <p>Your password for our website is: $password</p>
                <p>Please keep your password secure and do not share it with anyone.</p>
                <p>Thank you,</p>
                <p>Taxes City Car Spa</p>";

            // Send email
            $mail->send();
            // Return a success response
            echo 'success';
        } catch (Exception $e) {
            // Return an error response
            echo 'error';
        }
    } else {
        // Email not found in the database
        // Return a notfound response
        echo 'notfound';
    }

    
}

function forgotAdmin($conn, $email)
{
    $hardcoded_email = 'taco0267@gmail.com'; // Replace with your hardcoded admin email

    if ($email == $hardcoded_email) {
        // Create a PHPMailer instance
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'taco0267@gmail.com'; // Replace with your email address
            $mail->Password = 'oozn lpxj obyw isab'; // Replace with your email password
            $mail->SMTPSecure = 'ssl'; // Change to 'ssl' if required
            $mail->Port = 465; // Change to 465 if using SSL

            // Sender information
            $mail->setFrom('taco0267@gmail.com', 'AF CAR WASH'); // Replace with your company name and email

            // Recipient (admin)
            $mail->addAddress($hardcoded_email, 'Admin');

            // Email subject
            $mail->Subject = "Admin Credentials";

            // Fetch usernames and passwords from the table (assuming 'users' table)
            $sql = "SELECT username, password FROM admin WHERE username = 'manager'";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $managersResult = $stmt->get_result();

            $sql = "SELECT username, password FROM admin WHERE username = 'employee'";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $employeesResult = $stmt->get_result();

            // Construct the body of the email
            $body = "Dear Admin,<br><br>";
            $body .= "Here are the credentials for managers:<br><br>";
            while ($row = $managersResult->fetch_assoc()) {
                $body .= "Username: " . $row['username'] . " - Password: " . $row['password'] . "<br>";
            }

            $body .= "<br>Here are the credentials for employees:<br><br>";
            while ($row = $employeesResult->fetch_assoc()) {
                $body .= "Username: " . $row['username'] . " - Password: " . $row['password'] . "<br>";
            }

            $body .= "<br>Thank you,<br><br>";
            $body .= "AF CAR WASH"; // Replace with your company name

            $mail->isHTML(true);
            $mail->Body = $body;

            // Send the email
            if ($mail->send()) {
                // Return a success response
                echo 'success';
            } else {
                // Return an error response
                echo 'error';
            }
        } catch (Exception $e) {
            // Return an error response
            echo 'error';
        }
    } else {
        // Inputted email does not match the admin's email
        // Return a notfound response
        echo 'notfound';
    }
}
