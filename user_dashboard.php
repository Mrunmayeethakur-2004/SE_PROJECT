<?php
session_start();
if (!isset($_SESSION['email']) || $_SESSION['role'] != 'user') {
    header("Location: login.html");
    exit();
}
echo "Welcome, User! <a href='logout.php'>Logout</a>";
?>
