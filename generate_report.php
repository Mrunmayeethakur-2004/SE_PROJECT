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

// Fetch events created by the admin
$sql = "SELECT event_name, event_date, event_time, location, category FROM events ORDER BY event_date DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Reports</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            padding: 20px;
        }
        .report-container {
            max-width: 1000px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #001f3f;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #001f3f;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        .btn-generate {
            display: block;
            width: 100%;
            background-color: #001f3f;
            color: white;
            border: none;
            padding: 10px;
            font-size: 16px;
            margin-top: 20px;
            border-radius: 5px;
            text-align: center;
            cursor: pointer;
        }
        .btn-generate:hover {
            background-color: #004080;
        }
    </style>
</head>
<body>

<div class="report-container">
    <h2>Event Reports & Analytics</h2>
    <button class="btn-generate" onclick="generateReport()">Generate Report</button>

    <table>
        <thead>
            <tr>
                <th>Event Name</th>
                <th>Date</th>
                <th>Time</th>
                <th>Location</th>
                <th>Category</th>
            </tr>
        </thead>
        <tbody id="reportTable">
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row["event_name"]); ?></td>
                        <td><?php echo htmlspecialchars($row["event_date"]); ?></td>
                        <td><?php echo htmlspecialchars($row["event_time"]); ?></td>
                        <td><?php echo htmlspecialchars($row["location"]); ?></td>
                        <td><?php echo htmlspecialchars($row["category"]); ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center">No events found</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<script>
function generateReport() {
    alert("Report Generated Successfully!");
}
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

</body>
</html>

<?php $conn->close(); ?>
