<?php
session_start();
require '../config.php';

// Check if the user is logged in, if not redirect to login page
if (!isset($_SESSION['email'])) {
    header("Location: login_page.php");
    exit();
}

// Fetch user payment methods from the database
$email = $_SESSION['email'];
$stmt = $con->prepare("SELECT * FROM payment_methods WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$payment_methods = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
        }
        .sidebar {
            width: 200px;
            background-color: #f4f4f4;
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
        }
        .sidebar a {
            display: block;
            padding: 10px;
            text-decoration: none;
            color: #333;
            margin-bottom: 10px;
        }
        .sidebar a:hover {
            background-color: #ddd;
        }
        .main-content {
            flex-grow: 1;
            padding: 20px;
        }
        .section {
            margin-bottom: 20px;
        }
        .section h2 {
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 10px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input, .form-group select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
        .form-group button {
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            border: 6px;
            cursor: pointer;
        }
        .form-group button:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <div class="sidebar">
    <a href="clientdashb.php" class="nav-link" id="dashboard-link">Dashboard</a>
      <a href="scheduling.php" class="nav-link" id="scheduling-link">Scheduling</a>
      <a href="payment.php" class="nav-link" id="payment-link">Payment</a>
      <a href="login_page.php" class="nav-link" id="settings-link">Logout</a>
    </div>
    <div class="main-content">
        <div class="section">
            <h2>Payment Methods</h2>
            <div class="form-group">
                <h3>Add New Payment Method</h3>
                <form method="post" action="add_payment_method.php">
                    <label for="payment-type">Payment Type</label>
                    <select id="payment-type" name="payment_type">
                        <option value="Credit Card">Credit Card</option>
                        <option value="Debit Card">Debit Card</option>
                        <option value="PayPal">PayPal</option>
                        <!-- Add more options as needed -->
                    </select>
                    <label for="payment-details">Payment Details</label>
                    <input type="text" id="payment-details" name="payment_details" required>
                    <button type="submit">Add Payment Method</button>
                </form>
            </div>
        </div>
        <div class="section">
            <h3>Your Payment Methods</h3>
            <?php if (empty($payment_methods)) { ?>
                <p>No payment methods added yet.</p>
            <?php } else { ?>
                <ul>
                    <?php foreach ($payment_methods as $method) { ?>
                        <li><?php echo htmlspecialchars($method['payment_type'] . ": " . $method['payment_details']); ?></li>
                    <?php } ?>
                </ul>
            <?php } ?>
        </div>
    </div>
</body>
</html>
