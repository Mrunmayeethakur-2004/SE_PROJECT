function login() {
    let role = document.getElementById("role").value;
    let email = document.getElementById("email").value;
    let password = document.getElementById("password").value;

    if (email === "" || password === "") {
        alert("Please enter all fields!");
        return;
    }

    if (role === "admin") {
        window.location.href = "dashboard.html";  // Redirect admin to dashboard
    } else {
        window.location.href = "event-details.html";  // Redirect user to event details
    }
}
 function register() {
    let role = document.getElementById("role").value;
    let name = document.getElementById("name").value;
    let email = document.getElementById("email").value;
    let password = document.getElementById("password").value;
    let confirmPassword = document.getElementById("confirmPassword").value;

    if (name === "" || email === "" || password === "" || confirmPassword === "") {
        alert("Please fill all fields!");
        return;
    }

    if (password !== confirmPassword) {
        alert("Passwords do not match!");
        return;
    }

    alert("Registration Successful! You can now log in.");
    window.location.href = "login.html"; // Redirect to login page
}
document.getElementById("eventForm").addEventListener("submit", function(event) {
    event.preventDefault();
    
    let eventName = document.getElementById("eventName").value;
    let eventDate = document.getElementById("eventDate").value;
    let eventTime = document.getElementById("eventTime").value;
    let location = document.getElementById("location").value;
    let category = document.getElementById("category").value;
    let description = document.getElementById("description").value;

    if (eventName && eventDate && eventTime && location && category && description) {
        alert("Event '" + eventName + "' created successfully!");
        document.getElementById("eventForm").reset();
    } else {
        alert("Please fill all required fields.");
    }
});
document.getElementById("registrationForm").addEventListener("submit", function(event) {
    event.preventDefault();
    
    let fullName = document.getElementById("fullName").value;
    let email = document.getElementById("email").value;
    let phone = document.getElementById("phone").value;
    let eventSelect = document.getElementById("eventSelect").value;
    let ticketType = document.getElementById("ticketType").value;

    if (fullName && email && phone && eventSelect) {
        if (ticketType === "VIP") {
            document.getElementById("paymentSection").style.display = "block";
        } else {
            alert("Registration successful! Your ticket has been generated.");
            document.getElementById("registrationForm").reset();
        }
    } else {
        alert("Please fill all required fields.");
    }
});

function processPayment() {
    alert("Redirecting to payment gateway...");
}
document.getElementById("notificationForm").addEventListener("submit", function(event) {
    event.preventDefault();
    
    let fullName = document.getElementById("fullName").value;
    let email = document.getElementById("email").value;
    let phone = document.getElementById("phone").value;
    let notificationType = document.getElementById("notificationType").value;
    let eventUpdates = document.getElementById("eventUpdates").checked;

    if (fullName && email && phone) {
        alert(`Subscription successful! You'll receive notifications via ${notificationType}`);
        document.getElementById("notificationForm").reset();
    } else {
        alert("Please fill all required fields.");
    }
});

// Request push notification permission
function requestPushPermission() {
    if ('Notification' in window) {
        Notification.requestPermission().then(function(permission) {
            if (permission === "granted") {
                new Notification("You have enabled push notifications for event updates!");
            } else {
                alert("Push notifications are blocked. Please allow them in browser settings.");
            }
        });
    } else {
        alert("Your browser does not support push notifications.");
    }
}
document.getElementById("venueForm").addEventListener("submit", function(event) {
    event.preventDefault();

    let eventName = document.getElementById("eventName").value;
    let venue = document.getElementById("venue").value;
    let date = document.getElementById("date").value;
    let time = document.getElementById("time").value;
    let resources = Array.from(document.getElementById("resources").selectedOptions).map(option => option.value);

    if (eventName && venue && date && time) {
        alert(`Venue booked successfully for "${eventName}" at ${venue} on ${date} at ${time}. Resources: ${resources.join(", ")}`);
        document.getElementById("venueForm").reset();
    } else {
        alert("Please fill all required fields.");
    }
});
// Event Schedule Filtering
document.getElementById("filter")?.addEventListener("change", function() {
    let selectedCategory = this.value;
    let scheduleList = document.getElementById("schedule-list");
    
    scheduleList.innerHTML = `<p>Loading ${selectedCategory} events...</p>`;
    
    setTimeout(() => {
        scheduleList.innerHTML = `<p>Showing events for: ${selectedCategory}</p>`;
    }, 1000);
});

// Feedback Submission
document.getElementById("feedbackForm")?.addEventListener("submit", function(event) {
    event.preventDefault();
    
    let eventName = document.getElementById("eventName").value;
    let rating = document.getElementById("rating").value;
    let comments = document.getElementById("comments").value;

    if (rating && comments) {
        alert(`Thank you for your feedback on "${eventName}". Rating: ${rating}/5`);
        document.getElementById("feedbackForm").reset();
    } else {
        alert("Please fill in all fields.");
    }
});

// Generate Report
function generateReport() {
    let reportData = document.getElementById("reportData");
    reportData.innerHTML = "<p>Generating Report...</p>";

    setTimeout(() => {
        reportData.innerHTML = `<p>Event Report: 150 attendees, 10 workshops, 5 paid events.</p>`;
    }, 1500);
}

