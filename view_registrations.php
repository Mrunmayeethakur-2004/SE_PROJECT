<?php
$servername = "localhost";
$username = "root";  // Change if needed
$password = "";  // Change if needed
$dbname = "event_management";

// Connect to the database
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch events with registration counts
$sql = "SELECT e.id, e.event_name, COUNT(r.id) as total_registrations 
        FROM events e 
        LEFT JOIN event_registrations r ON e.id = r.event_id 
        GROUP BY e.id 
        ORDER BY e.event_date DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Registrations</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        .progress {
            height: 25px;
            border-radius: 10px;
            background-color: #e9ecef;
        }
        .progress-bar {
            font-weight: bold;
            font-size: 14px;
            line-height: 25px;
            border-radius: 10px;
            transition: width 0.5s ease-in-out;
        }
        .event-card {
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 10px;
            box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Event Registrations</h2>
        <?php while ($row = $result->fetch_assoc()): ?>
            <?php
                // Set the progress bar color based on the registration count
                if ($row['total_registrations'] < 10) {
                    $progress_class = 'bg-danger'; // Red for low registrations
                } elseif ($row['total_registrations'] < 50) {
                    $progress_class = 'bg-warning'; // Yellow for moderate registrations
                } else {
                    $progress_class = 'bg-success'; // Green for high registrations
                }
            ?>
            <div class="event-card">
                <h5><?php echo htmlspecialchars($row['event_name']); ?></h5>
                <div class="progress">
                    <div class="progress-bar <?php echo $progress_class; ?>" role="progressbar" 
                         style="width: <?php echo min($row['total_registrations'] * 10, 100); ?>%;" 
                         aria-valuenow="<?php echo $row['total_registrations']; ?>" aria-valuemin="0" aria-valuemax="100">
                        <?php echo $row['total_registrations']; ?> Registrations
                    </div>
                </div>
                <a href="registration_details.php?event_id=<?php echo $row['id']; ?>" class="btn btn-info btn-sm mt-2">View Details</a>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>

<?php $conn->close(); ?>
