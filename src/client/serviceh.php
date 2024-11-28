<?php
session_start();
require '../config.php';

// Check if the user is logged in, if not redirect to login page
if (!isset($_SESSION['email'])) {
    header("Location: login_page.php");
    exit();
}

// Fetch user's service history from the database
$email = $_SESSION['email'];
$stmt = $con->prepare("SELECT * FROM service_history WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$service_history = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service History</title>
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
            margin-bottom: 10px;
        }
        .service-item {
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 10px;
        }
        .service-item h3 {
            margin-top: 0;
        }
        .service-item p {
            margin: 5px 0;
        }
        .service-status {
            font-weight: bold;
        }
        .completed {
            color: green;
        }
        .scheduled {
            color: blue;
        }
        .cancelled {
            color: red;
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
            <h2>Service History</h2>
            <?php if (empty($service_history)) { ?>
                <p>No services found in your history.</p>
            <?php } else { ?>
                <?php foreach ($service_history as $service) { ?>
                    <div class="service-item">
                        <h3><?php echo htmlspecialchars($service['service_type']); ?></h3>
                        <p>Date: <?php echo htmlspecialchars($service['service_date']); ?></p>
                        <p>Time: <?php echo htmlspecialchars($service['service_time']); ?></p>
                        <p class="service-status <?php echo strtolower($service['status']); ?>">Status: <?php echo htmlspecialchars($service['status']); ?></p>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
</body>
</html>
