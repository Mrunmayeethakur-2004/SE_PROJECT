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

// Fetch events from the database
$sql = "SELECT * FROM events ORDER BY event_date DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        body { font-family: Arial, sans-serif; background-color: #f8f9fa; }
        .navbar { background: linear-gradient(90deg, #6a11cb, #2575fc); box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); }
        .navbar-brand { font-weight: bold; font-size: 24px; color: white; }
        .nav-item a { color: white; font-weight: 500; transition: color 0.3s ease-in-out; }
        .nav-item a:hover { color: #ffdd57; }
        .logout-btn { background-color: #ff4c4c; color: white !important; border-radius: 5px; padding: 5px 15px; }
        .logout-btn:hover { background-color: #d42e2e; }
        .banner { background: url('banner.png') no-repeat center center/cover; height: 250px; display: flex; align-items: center; justify-content: center; text-align: center; position: relative; color: white; font-size: 24px; font-weight: bold; }
        .banner::before { content: ""; position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); }
        .banner h1 { position: relative; z-index: 1; }
        .container { padding: 40px 20px; }
        .event-card { transition: transform 0.3s ease-in-out; }
        .event-card:hover { transform: scale(1.05); }
        .event-banner { width: 100%; height: 180px; object-fit: cover; border-top-left-radius: 10px; border-top-right-radius: 10px; }
    </style>
</head>
<body>
ADMINISTRATOR DASHBOARD....!!

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">COEP Technological University</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="event_creation.html">Event Creation & Management</a></li>
                    <li class="nav-item"><a class="nav-link" href="notifications.html">Notifications & Reminders</a></li>
                    <li class="nav-item"><a class="nav-link" href="map.html">Map</a></li>
                    <li class="nav-item"><a class="nav-link" href="fetch_past_events.php">Past Events</a></li>
                    <li class="nav-item"><a class="nav-link" href="generate_report.php">Reports & Analytics</a></li>
                    <li class="nav-item"><a class="nav-link logout-btn" href="login.html">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Banner -->
    <div class="banner">
        <h1>Welcome to the Event Management System</h1>
    </div>

    <!-- Main Content -->
    <div class="container">
        <h2 class="text-center">Upcoming Events</h2>
        <p class="text-center">Manage your events efficiently.</p>

        <div class="row mt-4">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="col-md-4">
                    <div class="card event-card shadow-sm">
                        <img src="<?php echo $row['event_banner']; ?>" class="event-banner" alt="Event Banner">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($row["event_name"]); ?></h5>
                            <p class="card-text"><strong>Date:</strong> <?php echo htmlspecialchars($row["event_date"]); ?></p>
                            <p class="card-text"><strong>Time:</strong> <?php echo htmlspecialchars($row["event_time"]); ?></p>
                            <p class="card-text"><strong>Location:</strong> <?php echo htmlspecialchars($row["location"]); ?></p>
                            <p class="card-text"><strong>Category:</strong> <?php echo htmlspecialchars($row["category"]); ?></p>
                            <p class="card-text"><?php echo nl2br(htmlspecialchars($row["description"])); ?></p>
                            <a href="<?php echo $row['event_brochure']; ?>" class="btn btn-primary" target="_blank">View Brochure</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php $conn->close(); ?>

<!-- admin_dashboard.html -->
<button id="pastEventsBtn">Past Events</button>
<div id="pastEvents"></div>

<script>
document.getElementById("pastEventsBtn").addEventListener("click", function() {
    fetch("fetch_past_events.php")
    .then(response => response.text())
    .then(data => {
        document.getElementById("pastEvents").innerHTML = data;
    });
});
</script>



