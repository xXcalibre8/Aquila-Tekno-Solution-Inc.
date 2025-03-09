<?php
session_start();
include("config.php");

function handlePasswordReset($con, $token, $newPassword, $confirmPassword) {
    if (!$token || !$newPassword || !$confirmPassword) {
        return "All fields are required.";
    }

    if ($newPassword !== $confirmPassword) {
        return "Passwords do not match.";
    }

    $stmt = $con->prepare("SELECT email FROM password_resets WHERE token = ? AND expires_at > NOW()");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        return "Invalid or expired token.";
    }

    $email = $result->fetch_assoc()['email'];
    
    try {
        $con->begin_transaction();

        // Update password
        $stmt = $con->prepare("UPDATE register SET pass = ? WHERE email = ?");
        $stmt->bind_param("ss", $newPassword, $email);
        $stmt->execute();

        // Clean up reset token
        $stmt = $con->prepare("DELETE FROM password_resets WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();

        $con->commit();
        return "success";
    } catch (Exception $e) {
        $con->rollback();
        return "Password reset failed. Please try again.";
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $result = handlePasswordReset(
        $con,
        $_POST['token'] ?? '',
        $_POST['new_password'] ?? '',
        $_POST['confirm_password'] ?? ''
    );

    if ($result === "success") {
        echo "<script>
            alert('Password updated successfully.');
            window.location.href='login_page.php';
        </script>";
        exit();
    }
    $msg = $result;
} elseif (!isset($_GET['token'])) {
    header("Location: login_page.php");
    exit();
}

$token = $_GET['token'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <style>
        body { 
            background-color: #56a3ff; 
            padding-top: 50px;
        }
        .box {
            max-width: 500px;
            background-color: #f9f9f9;
            border-radius: 5px;
            padding: 20px;
            margin: 0 auto;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .error {
            color: #dc3545;
            font-weight: 600;
            margin-top: 10px;
        }
        .form-group { margin-bottom: 20px; }
        h3 { margin-bottom: 30px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="box">
            <h3 class="text-center">Reset Password</h3>
            <form method="POST">
                <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
                
                <div class="form-group">
                    <label for="new_password">New Password</label>
                    <input type="password" name="new_password" id="new_password" 
                           class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" name="confirm_password" id="confirm_password" 
                           class="form-control" required>
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-block">Reset Password</button>
                </div>
                
                <?php if(!empty($msg)): ?>
                    <p class="error text-center"><?= htmlspecialchars($msg) ?></p>
                <?php endif; ?>
            </form>
        </div>
    </div>
</body>
</html>