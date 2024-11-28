<?php
session_start();
include("config.php");
require '../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['recovery_option'])) {
        $recovery_option = $_POST['recovery_option'];
        
        if ($recovery_option == 'email') {
            $email = $_POST['email'];

            // Validate email input
            if (!empty($email)) {
                $stmt = $con->prepare("SELECT * FROM register WHERE email = ?");
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    // User found, send recovery email
                    $token = bin2hex(random_bytes(16)); // Generate a shorter token
                    $expires_at = date("Y-m-d H:i:s", strtotime("+24 hours")); // Token expiry time set to 24 hours

                    // Save token in the database
                    $stmt = $con->prepare("INSERT INTO password_resets (email, token, expires_at) VALUES (?, ?, ?)");
                    $stmt->bind_param("sss", $email, $token, $expires_at);
                    if ($stmt->execute()) {
                        // Send recovery email
                        $mail = new PHPMailer(true);
                        try {
                            $mail->isSMTP();
                            $mail->Host = 'smtp.gmail.com'; // Replace with your SMTP server
                            $mail->SMTPAuth = true;
                            $mail->Username = 'aquilatekno@gmail.com'; // Replace with your email
                            $mail->Password = 'ofvrnqpchavqnref'; // Replace with your email password or app password
                            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                            $mail->Port = 587;

                            $mail->setFrom('aquilatekno@gmail.com', 'Aquila Tekno Solutions');
                            $mail->addAddress($email);

                            $mail->isHTML(true);
                            $mail->Subject = 'Password Recovery';
                            $mail->Body = "Click the following link to reset your password: <a href='http://localhost:90/draftwebsite/reset_password.php?token=$token'>Reset Password</a>";

                            $mail->send();
                            echo "<script type='text/javascript'>alert('Recovery email sent. Please check your inbox.');</script>";
                        } catch (Exception $e) {
                            echo "<script type='text/javascript'>alert('Failed to send recovery email: {$mail->ErrorInfo}');</script>";
                        }
                    } else {
                        echo "<script type='text/javascript'>alert('Failed to generate recovery token. Please try again later.');</script>";
                    }
                } else {
                    echo "<script type='text/javascript'>alert('No account found with that email.');</script>";
                }
                $stmt->close();
            } else {
                echo "<script type='text/javascript'>alert('Please enter your email.');</script>";
            }
        } elseif ($recovery_option == 'phone') {
            // Handle phone recovery option here
            echo "<script type='text/javascript'>alert('Phone recovery not implemented yet.');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="login_page.css">
</head>
<body>

<video autoplay muted loop class="bg-video3">
    <source src="design/bg.mp4" type="video/mp4">
    Your browser does not support the video tag.
</video>

    <div class="container">
        <div class="table-responsive">
            <div class="box2">
                <form method="POST">
                    <div class="forgot-email">
                        <label for="email">Enter your email:</label>
                        <br>
                        <input type="text" name="email" id="email" placeholder="Email" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label for="recovery_option">Choose recovery option:</label>
                        <select name="recovery_option" id="recovery_option" class="recov-opt" required>
                            <option value="email">Email</option>
                            <option value="phone">Phone (Not implemented)</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Submit" class="submit-button" />
                    </div>
                    <p class="error"><?php if(!empty($msg)){ echo $msg; } ?></p>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
