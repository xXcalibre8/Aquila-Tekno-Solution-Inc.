<?php
session_start();
require '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['payment_type']) && isset($_POST['payment_details'])) {
    $payment_type = $_POST['payment_type'];
    $payment_details = $_POST['payment_details'];
    $email = $_SESSION['email'];

    $stmt = $con->prepare("INSERT INTO payment_methods (email, payment_type, payment_details) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $email, $payment_type, $payment_details);

    if ($stmt->execute()) {
        echo "<script type='text/javascript'>alert('Payment method added successfully.'); window.location.href = 'client_dashboard.php';</script>";
    } else {
        echo "<script type='text/javascript'>alert('Failed to add payment method. Please try again.'); window.location.href = 'client_dashboard.php';</script>";
    }

    $stmt->close();
} else {
    header("Location: client_dashboard.php");
    exit();
}
?>
