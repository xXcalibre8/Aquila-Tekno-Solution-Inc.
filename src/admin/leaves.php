<?php
// Include database connection
include("../config.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Candidates - AQUILA CORPS</title>
    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="candidates.css">
    <link rel="stylesheet" href="newdb.css"> <!-- Add this for sidebar styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
<div class="container">
    <!-- New Improved Sidebar -->
    <div class="sidebar">
        <div class="logo-section">
            <img src="../design/aquila.png" alt="Logo">
            <h1>AQUILA CORPS</h1>
        </div>
        <nav class="nav-menu">
            <a href="dashboard.php" class="nav-link">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
            </a>
            <a href="all_employees.php" class="nav-link">
                <i class="fas fa-users"></i>
                <span>Employees</span>
            </a>
            <a href="all_departments.php" class="nav-link">
                <i class="fas fa-building"></i>
                <span>Departments</span>
            </a>
            <a href="attendance.php" class="nav-link">
                <i class="fas fa-clock"></i>
                <span>Attendance</span>
            </a>
            <a href="jobs.php" class="nav-link">
                <i class="fas fa-briefcase"></i>
                <span>Jobs</span>
            </a>
            <a href="candidates.php" class="nav-link">
                <i class="fas fa-user-tie"></i>
                <span>Candidates</span>
            </a>
            <a href="leaves.php" class="nav-link">
                <i class="fas fa-calendar-minus"></i>
                <span>Leaves</span>
            </a>
            <a href="holidays.php" class="nav-link">
                <i class="fas fa-calendar"></i>
                <span>Holidays</span>
            </a>
            <a href="../login_page.php" class="nav-link logout">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="content-overlay">
            <p>Welcome Admin</p>
            
           

</body>
</html>