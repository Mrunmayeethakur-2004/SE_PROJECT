require("dotenv").config(); // Load environment variables from .env file
const express = require("express");
const nodemailer = require("nodemailer");
const cors = require("cors");
const bodyParser = require("body-parser");

const app = express();
const PORT = 5000;

app.use(cors());
app.use(bodyParser.json());

const transporter = nodemailer.createTransport({
    service: "gmail",
    auth: {
        user: process.env.EMAIL_USER,  // Get email from environment variable
        pass: process.env.EMAIL_PASS   // Get password from environment variable
    }
});

app.post("/send-email", async (req, res) => {
    const { fullName, email } = req.body;

    if (!fullName || !email) {
        return res.status(400).json({ error: "Full Name and Email are required" });
    }

    const mailOptions = {
        from: process.env.EMAIL_USER,  // Use sender's email from environment variables
        to: email,
        subject: "Event Subscription Confirmation",
        text: `Hello ${fullName},\n\nThank you for subscribing to event notifications!\n\nBest Regards,\nCOEP Event Team`
    };

    try {
        await transporter.sendMail(mailOptions);
        res.status(200).json({ message: "✅ Email sent successfully!" });
    } catch (error) {
        console.error("Email sending failed:", error);
        res.status(500).json({ error: "Failed to send email" });
    }
});

// Start Server
app.listen(PORT, () => {
    console.log(`Server running on http://localhost:${PORT}`);
});
