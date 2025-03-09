<?php
session_start();
include("config.php");
require '../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function sendResetEmail($email, $token) {
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
        
        $resetLink = "http://localhost/Webauth/src/reset_password.php?token=" . $token;
        $mail->Subject = 'Password Reset Request';
        $mail->Body = "Click the link below to reset your password:<br><a href='$resetLink'>Reset Password</a>";

        return $mail->send();
    } catch (Exception $e) {
        return false;
    }
}

function handlePasswordReset($con, $email) {
    if (empty($email)) {
        return "Please enter your email address.";
    }

    $stmt = $con->prepare("SELECT * FROM register WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    
    if ($stmt->get_result()->num_rows === 0) {
        return "Email not found in our records.";
    }

    try {
        $token = bin2hex(random_bytes(16));
        $expires_at = date("Y-m-d H:i:s", strtotime("+24 hours"));

        $stmt = $con->prepare("INSERT INTO password_resets (email, token, expires_at) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $email, $token, $expires_at);
        
        if ($stmt->execute() && sendResetEmail($email, $token)) {
            return "success";
        }
        return "Failed to send reset email. Please try again.";
    } catch (Exception $e) {
        return "An error occurred. Please try again.";
    }
}

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['recovery_option'])) {
    if ($_POST['recovery_option'] == 'email') {
        $result = handlePasswordReset($con, $_POST['email'] ?? '');
        if ($result === "success") {
            echo "<script>alert('Password reset link sent to your email.');</script>";
        } else {
            echo "<script>alert('$result');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Recovery</title>
    <link rel="stylesheet" href="login_page.css">
</head>
<body>
    <video autoplay muted loop class="bg-video3">
        <source src="design/bg.mp4" type="video/mp4">
    </video>

    <div class="container">
        <div class="box2">
            <div class="header-section">
                <img src="design/aquila.png" alt="System Logo" class="logo">
                <h2 class="company-name">Aquila Tekno Solutions Inc.</h2>
                <h3 class="page-title">Password Recovery</h3>
            </div>
            <form method="POST">
                <div class="forgot-email">
                    <label>Recovery Method:</label>
                    <select name="recovery_option" required>
                        <option value="email">Email</option>
                    </select>
                </div>
                <div class="forgot-email">
                    <label>Email:</label>
                    <input type="email" name="email" required>
                </div>
                <div class="button-container">
                    <button type="submit" class="verify-button">Send Reset Link</button>
                    <button type="button" class="resend-button" onclick="window.location.href='login_page.php'">Back to Login</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>