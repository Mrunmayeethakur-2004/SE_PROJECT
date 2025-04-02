<?php
$servername = "localhost";
$username = "root";  // Update if needed
$password = "";  // Update if needed
$dbname = "event_management";

// Connect to database
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if event_id is provided
if (!isset($_GET['event_id']) || empty($_GET['event_id'])) {
    die("Invalid event ID. <a href='user_dashboard.php'>Go back</a>");
}

$event_id = intval($_GET['event_id']); // Convert to integer for security

// Fetch event details
$sql = "SELECT * FROM events WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $event_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("Event not found. <a href='user_dashboard.php'>Go back</a>");
}

$event = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register for Event</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Register for "<?php echo htmlspecialchars($event['event_name']); ?>"</h2>
        <p><strong>Date:</strong> <?php echo htmlspecialchars($event['event_date']); ?></p>
        <p><strong>Time:</strong> <?php echo htmlspecialchars($event['event_time']); ?></p>
        <p><strong>Location:</strong> <?php echo htmlspecialchars($event['location']); ?></p>
        <p><strong>Description:</strong> <?php echo nl2br(htmlspecialchars($event['description'])); ?></p>

        <form action="submit_registration.php" method="POST">
            <input type="hidden" name="event_id" value="<?php echo $event_id; ?>">
            <div class="mb-3">
                <label for="name" class="form-label">Your Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Your Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
            <a href="user_dashboard.php" class="btn btn-secondary">Back</a>
        </form>
    </div>
</body>
</html>

<?php
$conn->close();
?>
