<?php
session_start();
require 'config.php';
date_default_timezone_set('Asia/Manila');

function sendOTPEmail($email, $otp) {
    // Implement the function to send OTP email
    // For example, using PHP's mail function
    $subject = "Your OTP Code";
    $message = "Your OTP code is: $otp";
    $headers = "From: no-reply@yourdomain.com";

    return mail($email, $subject, $message, $headers);
}

if (!isset($_SESSION['email'])) {
    header('Location: login_page.php');
    exit();
}

function handleOTPVerification($con, $email, $otp) {
    $stmt = $con->prepare("SELECT * FROM otp_requests WHERE email = ? AND otp = ? AND expires_at >= NOW()");
    $stmt->bind_param("ss", $email, $otp);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        return ['success' => false, 'message' => 'Invalid or expired OTP.'];
    }

    $con->begin_transaction();
    try {
        // Delete OTP record
        $stmt = $con->prepare("DELETE FROM otp_requests WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();

        // Get user details
        $stmt = $con->prepare("SELECT id, roles, lname, username FROM register WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $user = $stmt->get_result()->fetch_assoc();

        $_SESSION = array_merge($_SESSION, $user);
        $con->commit();

        $redirect = $user['roles'] === 'admin' ? 'admin/dashboard.php' : 'client/clientdashb.php';
        return ['success' => true, 'redirect' => $redirect];
    } catch (Exception $e) {
        $con->rollback();
        return ['success' => false, 'message' => 'System error. Please try again.'];
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_SESSION['email'];
    
    if (isset($_POST['otp'])) {
        $result = handleOTPVerification($con, $email, $_POST['otp']);
        if ($result['success']) {
            echo "<script>
                alert('OTP verified successfully.');
                window.location.href = '{$result['redirect']}';
            </script>";
            exit();
        }
        echo "<script>alert('{$result['message']}');</script>";
    } 
    
    if (isset($_POST['resend'])) {
        $otp = rand(100000, 999999);
        $expires_at = date("Y-m-d H:i:s", strtotime('+5 minutes'));
        
        $stmt = $con->prepare("INSERT INTO otp_requests (email, otp, expires_at) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $email, $otp, $expires_at);
        
        if ($stmt->execute() && sendOTPEmail($email, $otp)) {
            echo "<script>alert('New OTP sent to your email.');</script>";
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
                <h5>Enter your pin:</h5>
                <input type="text" id="otp" name="otp" required>
                <div class="button-container">
                    <button type="submit" class="verify-button">Verify</button>
                    <button type="submit" name="resend" class="resend-button" id="resendButton" disabled>
                        Resend OTP (<span id="timer">60</span>s)
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        window.onload = () => {
            const resendButton = document.getElementById('resendButton');
            const timerDisplay = document.getElementById('timer');
            let timeLeft = 60;
            
            const updateTimer = () => {
                timeLeft--;
                timerDisplay.textContent = timeLeft;
                
                if (timeLeft <= 0) {
                    clearInterval(timer);
                    resendButton.disabled = false;
                    resendButton.innerHTML = 'Resend OTP';
                }
            };
            
            const timer = setInterval(updateTimer, 1000);
            
            resendButton.addEventListener('click', () => {
                if (!resendButton.disabled) {
                    timeLeft = 60;
                    timerDisplay.textContent = timeLeft;
                    resendButton.disabled = true;
                    resendButton.innerHTML = `Resend OTP (<span id="timer">60</span>s)`;
                }
            });
        };
    </script>
</body>
</html>