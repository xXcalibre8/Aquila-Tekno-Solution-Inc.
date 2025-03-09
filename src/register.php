<?php
session_start();
require 'config.php';

function handleRegistration($con, $data) {
    try {
        // Validate required fields
        if (empty($data['mail']) || empty($data['pass'])) {
            return ['success' => false, 'message' => 'Please Enter Valid Information'];
        }

        // Check if email exists
        $stmt = $con->prepare("SELECT email FROM register WHERE email = ?");
        $stmt->bind_param("s", $data['mail']);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            return ['success' => false, 'message' => 'Email already registered'];
        }
        $stmt->close();

        // Insert new user
        $stmt = $con->prepare("INSERT INTO register (fname, lname, gender, cnum, address, email, pass) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", 
            $data['fname'], 
            $data['lname'], 
            $data['gender'], 
            $data['number'], 
            $data['address'], 
            $data['mail'], 
            $data['pass']
        );
        
        $success = $stmt->execute();
        $stmt->close();
        
        return [
            'success' => $success,
            'message' => $success ? 'Successfully Registered' : 'Registration Failed'
        ];
    } catch (mysqli_sql_exception $e) {
        // Log error for debugging (optional)
        error_log($e->getMessage());
        return [
            'success' => false,
            'message' => 'An error occurred during registration. Please try again.'
        ];
    }
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $result = handleRegistration($con, $_POST);
    echo "<script>alert('{$result['message']}');</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AQUILA CORPS - Register</title>
    <link rel="stylesheet" href="login_page.css">
</head>
<body>
    <div class="signup">
        <h1>Register</h1>
        <form method="POST">
            <label for="fname">First Name</label>
            <input type="text" id="fname" name="fname" required>
            
            <label for="lname">Last Name</label>
            <input type="text" id="lname" name="lname" required>
            
            <label for="gender">Gender</label>
            <input type="text" id="gender" name="gender" required>
            
            <label for="number">Contact Number</label>
            <input type="tel" id="number" name="number" required>

            <label for="address">Address</label>
            <input type="text" id="address" name="address" required>
            
            <label for="mail">Email</label>
            <input type="email" id="mail" name="mail" required>
            
            <label for="pass">Password</label>
            <input type="password" id="pass" name="pass" required>
            
            <input type="submit" value="Register">
        </form>
        <p>Already have an account? <a href="login_page.php">Login Here</a></p>
    </div>

    <video autoplay muted loop class="background-video">
        <source src="design/bg.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>
</body>
</html>
