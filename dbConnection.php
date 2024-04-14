<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "afcarwash";

$conn = new mysqli($servername, $username, $password, $dbname);

//Check error
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

