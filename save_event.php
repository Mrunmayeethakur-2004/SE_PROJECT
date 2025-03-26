<?php
$servername = "localhost";
$username = "root";  // Default for XAMPP
$password = "";  // Default for XAMPP
$dbname = "event_management";

// Connect to database
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $event_name = $_POST['event_name'];
    $event_date = $_POST['event_date'];
    $event_time = $_POST['event_time'];
    $location = $_POST['location'];
    $category = $_POST['category'];
    $description = $_POST['description'];

    // Handle file uploads
    $target_dir = "uploads/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir);
    }
    $event_banner = $target_dir . basename($_FILES["event_banner"]["name"]);
    $event_brochure = $target_dir . basename($_FILES["event_brochure"]["name"]);

    move_uploaded_file($_FILES["event_banner"]["tmp_name"], $event_banner);
    move_uploaded_file($_FILES["event_brochure"]["tmp_name"], $event_brochure);

    // Insert data into database
    $sql = "INSERT INTO events (event_name, event_date, event_time, location, category, description, event_banner, event_brochure) 
            VALUES ('$event_name', '$event_date', '$event_time', '$location', '$category', '$description', '$event_banner', '$event_brochure')";

    if ($conn->query($sql) === TRUE) {
        echo "Event created successfully!";
        header("Location: admin_dashboard.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
