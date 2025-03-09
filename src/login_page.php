<?php
session_start();
include("config.php");
require '../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

date_default_timezone_set('Asia/Manila'); // Set to your timezone

function sendOTP($email, $otp) {
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'aquilatekno@gmail.com';
        $mail->Password = 'ofvrnqpchavqnref';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('aquilatekno@gmail.com', 'Aquila Tekno Solutions');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Your Login OTP';
        $mail->Body = "Your OTP for login is: <b>$otp</b>";

        return $mail->send();
    } catch (Exception $e) {
        return false;
    }
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        echo "<script>alert('Please fill in both fields.');</script>";
        exit;
    }

    $stmt = $con->prepare("SELECT * FROM register WHERE email = ? AND pass = ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['email'] = $email;
        $user = $result->fetch_assoc();

        if (isset($_COOKIE['remember_me']) && $_COOKIE['remember_me'] === $email) {
            $_SESSION['user'] = $email;
            header("Location: dashboard.php");
            exit;
        }

        $otp = rand(100000, 999999);
        $expires_at = date("Y-m-d H:i:s", strtotime("+5 minutes"));

        $stmt = $con->prepare("INSERT INTO otp_requests (email, otp, expires_at) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $email, $otp, $expires_at);

        if ($stmt->execute() && sendOTP($email, $otp)) {
            header("Location: otpverify.php");
            exit;
        } else {
            echo "<script>alert('Failed to send OTP. Please try again.');</script>";
        }
    } else {
        echo "<script>alert('Invalid email or password.');</script>";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AQUILA CORPS</title>
    <link rel="stylesheet" href="login_page.css">
</head>
<body>

<video autoplay muted loop class="background-video">
    <source src="design/bg.mp4" type="video/mp4">
    Your browser does not support the video tag.
</video>

<div class="login-container">
    <div class="login-box">
        <img src="design/aquila.png" alt="System Logo" class="logo">
        
        <h2>Aquila Tekno Solutions Inc.</h2>

        <!-- Login -->
        <form method="POST" id="login-form">
            <div class="input-group">
                <input type="text" name="email" placeholder="Enter your email" required>
            </div>
            <div class="input-group">
                <input type="password" name="password" placeholder="Enter your password" required>
            </div>
            <div class="button-group">
                <button type="submit" name="login" class="login-button">Log in</button>
                <button type="button" class="register-button" onclick="window.location.href='register.php'">Register</button>
            </div>
        </form>

        <!-- Forgot Password Link -->
        <a href="forgotps.php" class="forgot-password">Forgot Password?</a>
    </div>
</div>

</body>
</html>