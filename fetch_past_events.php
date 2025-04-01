<?php
$servername = "localhost";
$username = "root";  // Change if needed
$password = "";  // Change if needed
$dbname = "event_management";

// Connect to database
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch past events (events before today)
$sql = "SELECT * FROM events WHERE event_date < CURDATE() ORDER BY event_date DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Past Events</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            padding: 20px;
        }
        .event-container {
            max-width: 900px;
            margin: auto;
        }
        .event-card {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease-in-out;
            margin-bottom: 20px;
        }
        .event-card:hover {
            transform: scale(1.05);
        }
        .event-header {
            background: linear-gradient(90deg, #001f3f, #004080);
            padding: 15px;
            color: white;
            font-size: 18px;
            font-weight: bold;
            text-align: center;
        }
        .event-body {
            padding: 20px;
        }
        .event-details {
            font-size: 14px;
            color: #555;
        }
        .event-footer {
            padding: 15px;
            text-align: center;
            background: #f1f1f1;
        }
        .btn-primary {
            background-color: #001f3f;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
        }
        .btn-primary:hover {
            background-color: #004080;
        }
    </style>
</head>
<body>

<div class="event-container">
    <h2 class="text-center mb-4" style="color: #001f3f;">Past Events</h2>

    <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="event-card">
                <div class="event-header"><?php echo htmlspecialchars($row["event_name"]); ?></div>
                <div class="event-body">
                    <p class="event-details"><strong>Date:</strong> <?php echo htmlspecialchars($row["event_date"]); ?></p>
                    <p class="event-details"><strong>Time:</strong> <?php echo htmlspecialchars($row["event_time"]); ?></p>
                    <p class="event-details"><strong>Location:</strong> <?php echo htmlspecialchars($row["location"]); ?></p>
                    <p class="event-details"><strong>Category:</strong> <?php echo htmlspecialchars($row["category"]); ?></p>
                    <p><?php echo nl2br(htmlspecialchars($row["description"])); ?></p>
                </div>
                <div class="event-footer">
                    <a href="<?php echo $row['event_brochure']; ?>" class="btn btn-primary" target="_blank">View Brochure</a>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p class="text-center" style="color: #001f3f;">No past events found.</p>
    <?php endif; ?>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

</body>
</html>

<?php $conn->close(); ?>
