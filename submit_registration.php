This is my submit_registration.php file code                                                                                                   <?php
$servername = "localhost";
$username = "root";  // Update if needed
$password = "";  // Update if needed
$dbname = "event_management";

// Connect to database
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $event_id = intval($_POST['event_id']);
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);

    if (empty($name) || empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid input. <a href='user_dashboard.php'>Go back</a>");
    }

    // Insert registration into the database
    $sql = "INSERT INTO event_registrations (event_id, user_name, user_email) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss", $event_id, $name, $email);

    if ($stmt->execute()) {
        // Redirect back with success message
        header("Location: user_dashboard.php?message=Registration successful!");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
    
    $stmt->close();
}

$conn->close();
?>
