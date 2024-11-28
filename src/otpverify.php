<?php
session_start();
require 'config.php';
date_default_timezone_set('Asia/Manila'); // Set the default timezone to match your server's timezone
require '../vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['otp'])) {
        $otp = $_POST['otp'];
        $email = $_SESSION['email'];

        // Check if OTP is valid
        $stmt = $con->prepare("SELECT * FROM otp_requests WHERE email = ? AND otp = ? AND expires_at >= NOW()");
        $stmt->bind_param("ss", $email, $otp);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // OTP is valid, remove OTP entry from database
            $stmt = $con->prepare("DELETE FROM otp_requests WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();

            // Retrieve user role from the database
            $stmt = $con->prepare("SELECT role FROM register WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            // Get user role from session
            $role = $row['role'];

            // Redirect based on role
            if ($role == 'admin') {
                echo "<script type='text/javascript'>
                    alert('OTP verified successfully. Redirecting to dashboard.');
                    window.location.href = 'admin/dashboard.php';
                </script>";
            } else {
                echo "<script type='text/javascript'>
                    alert('OTP verified successfully. Redirecting to client dashboard.');
                    window.location.href = 'client/clientdashb.php';
                </script>";
            }
        } else {
            // Invalid OTP
            echo "<script type='text/javascript'>alert('Invalid or expired OTP. Please try again.');</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
    <link rel="stylesheet" href="login_page.css">
</head>
<body>

<video autoplay muted loop class="bg-video">
    <source src="design/bg.mp4" type="video/mp4">
    Your browser does not support the video tag.
</video>

<div class="otp-container">
    <div class="otp-box">
        <img src="design/aquila.png" alt="System Logo" class="logo">
        
        <h4>Aquila Tekno Solutions Inc.</h4>

<form method="POST">
    <h5>Please enter your OTP</h5>
    <input type="text" id="otp" name="otp" required>
    <button type="submit" class="verify-button">Verify</button>
</form>
</body>
</html>
