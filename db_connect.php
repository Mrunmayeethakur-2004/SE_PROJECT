<?php
$servername = "localhost"; 
$username = "root"; // Default XAMPP MySQL username
$password = ""; // Default password is empty
$dbname = "event_management"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
