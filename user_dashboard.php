<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        
        /* Updated Navbar Styling */
        .navbar {
            background: linear-gradient(90deg, #6a11cb, #2575fc);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 24px;
            color: white;
        }
        .nav-item a {
            color: white;
            font-weight: 500;
            transition: color 0.3s ease-in-out;
        }
        .nav-item a:hover {
            color: #ffdd57;
        }
        
        /* Logout Button */
        .logout-btn {
            background-color: #ff4c4c;
            color: white !important;
            border-radius: 5px;
            padding: 5px 15px;
        }
        .logout-btn:hover {
            background-color: #d42e2e;
        }

        /* Improved Banner Styling */
        .banner {
            background: url('banner.png') no-repeat center center/cover;
            height: 250px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            position: relative;
            color: white;
            font-size: 24px;
            font-weight: bold;
        }
        .banner::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5); /* Dark overlay for better text visibility */
        }
        .banner h1 {
            position: relative;
            z-index: 1;
        }

        /* Centering Content */
        .container {
            padding: 40px 20px;
        }
    </style>
</head>
<body>
    USER DASHBOARD....!!
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">COEP Technological University</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="event_creation.html">Event Registration</a></li>
                   <!---- <li class="nav-item"><a class="nav-link" href="event_registration.html">Online Registration & Ticketing</a></li>-->
                    <li class="nav-item"><a class="nav-link" href="notifications.html">Notifications & Reminders</a></li>
                    <li class="nav-item"><a class="nav-link" href="map.html">Map</a></li>
                    <li class="nav-item"><a class="nav-link" href="fetch_past_events.php">Past Events</a></li>                    <!--<li class="nav-item"><a class="nav-link" href="feedback.html">Feedback & Reviews</a></li>-->
                  <!--  <li class="nav-item"><a class="nav-link" href="generate_report.php">Reports & Analytics</a></li>-->
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

        
