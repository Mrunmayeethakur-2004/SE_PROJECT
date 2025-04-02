<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "event_management";

// Connect to database
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if event_id (which is actually 'id') is set
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['event_id']) && !empty($_POST['event_id'])) {
        $event_id = intval($_POST['event_id']); // Convert to integer for security

        // Prepare DELETE query
        $sql = "DELETE FROM events WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $event_id);

        if ($stmt->execute()) {
            header("Location: admin_dashboard.php?message=Event deleted successfully");
            exit();
        } else {
            echo "Error deleting event: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "No event ID provided!";
    }
} else {
    echo "Invalid request!";
}

$conn->close();
?>
