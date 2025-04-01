<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $role = $_POST['role'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password for security

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO users (role, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $role, $email, $password);

    if ($stmt->execute()) {
        // Redirect to success page
        header("Location: registration_success.html");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
$conn->close();
?>
