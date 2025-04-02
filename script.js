document.getElementById("notificationForm").addEventListener("submit", async function (event) {
    event.preventDefault();

    const fullName = document.getElementById("fullName").value;
    const email = document.getElementById("email").value;
    const senderEmail = document.getElementById("senderEmail").value; // Get sender's email
    const senderPassword = document.getElementById("senderPassword").value; // Get sender's password

    const response = await fetch("http://localhost:5000/send-email", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ fullName, email, senderEmail, senderPassword })
    });

    const data = await response.json();
    document.getElementById("statusMessage").textContent = data.message || `❌ Error: ${data.error}`;
});
