<?php
require __DIR__ . '/vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "event_management";

// Connect to database
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $event_id = intval($_POST['event_id']);
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);

    if (empty($name) || empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid input. <a href='user_dashboard.php'>Go back</a>");
    }

    // Insert into event_registrations
    $sql = "INSERT INTO event_registrations (event_id, user_name, user_email) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss", $event_id, $name, $email);

    if ($stmt->execute()) {
        // Fetch event details
        $stmt = $conn->prepare("SELECT * FROM events WHERE id = ?");
        $stmt->bind_param("i", $event_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            die("Invalid event.");
        }

        $event = $result->fetch_assoc();
        $eventTitle = $event['event_name'];
        $eventDate = $event['event_date'];
        $eventTime = $event['event_time'];
        $eventLocation = $event['location'];

        // Send email without attachment
        $mail = new PHPMailer(true);

        try {
            $mail->SMTPDebug = 2; // Or use 3 or 4 for more detail
            $mail->Debugoutput = 'html'; // Format debug output nicely
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'mrunmayeethakur5@gmail.com';  // your Gmail
            $mail->Password = 'qdta mztn qgbp eaya';         // Gmail App Password
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
            $mail->setFrom('mrunmayeethakur5@gmail.com', 'COEP Events');
            $mail->addAddress($email, $name);

            $mail->isHTML(true);
            $mail->Subject = '🎟 Your Registration for ' . $eventTitle;
            $mail->Body = "
                  Hi $name,<br><br>
                 Thank you for registering for <strong>$eventTitle</strong>!<br>
                 Event Date: $eventDate<br>
                 Event Time: $eventTime<br>
                 Location: $eventLocation<br><br>
                 COEP Events Team
             ";

            $mail->send();
            // Redirect to the dashboard page before echoing success message
            header("Location: user_dashboard.php?message=Registration successful! Ticket info sent.");
            exit();
        } catch (Exception $e) {
            echo "❌ PHPMailer Error: " . $mail->ErrorInfo;
        }
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>