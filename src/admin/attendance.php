<?php
// Include database connection
include("../config.php");

// Check if connection is successful
if (!isset($con) || $con->connect_error) {
    die("Connection failed: " . ($con->connect_error ?? "Database connection variable not defined"));
}

// Additional attendance-specific code would go here
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance - AQUILA CORPS</title>
    <link rel="stylesheet" href="attendance.css">
    <link rel="stylesheet" href="newdb.css"> <!-- For sidebar styling -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <div class="container">
        <!-- Sidebar copied from dashboard.php -->
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

        <!-- Main content -->
        <div class="attendance-main-content">
            <div class="attendance-header">
                <h1>Attendance Management</h1>
            </div>
            
            <div class="attendance-content">
                <!-- Attendance management content will go here -->
                <div class="attendance-card">
                    <h2>Today's Attendance</h2>
                    <div class="attendance-stats">
                        <div class="stat-item">
                            <div class="stat-value present">25</div>
                            <div class="stat-label">Present</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value absent">5</div>
                            <div class="stat-label">Absent</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value late">3</div>
                            <div class="stat-label">Late</div>
                        </div>
                    </div>
                </div>
                
                <div class="attendance-table-container">
                    <div class="table-header">
                        <div class="table-title">Employee Attendance</div>
                        <div class="table-actions">
                            <input type="date" id="attendance-date" class="date-picker">
                            <button class="btn-primary">View Report</button>
                        </div>
                    </div>
                    <table class="attendance-table">
                        <thead>
                            <tr>
                                <th>Employee Name</th>
                                <th>Employee ID</th>
                                <th>Department</th>
                                <th>Date</th>
                                <th>Check In</th>
                                <th>Check Out</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Sample data - would be populated from the database -->
                            <tr>
                                <td>John Doe</td>
                                <td>EMP001</td>
                                <td>IT Department</td>
                                <td>2025-03-10</td>
                                <td>09:00 AM</td>
                                <td>05:30 PM</td>
                                <td><span class="status present">Present</span></td>
                            </tr>
                            <tr>
                                <td>Jane Smith</td>
                                <td>EMP002</td>
                                <td>HR Department</td>
                                <td>2025-03-10</td>
                                <td>09:15 AM</td>
                                <td>05:45 PM</td>
                                <td><span class="status late">Late</span></td>
                            </tr>
                            <tr>
                                <td>Mike Johnson</td>
                                <td>EMP003</td>
                                <td>Finance</td>
                                <td>2025-03-10</td>
                                <td>-</td>
                                <td>-</td>
                                <td><span class="status absent">Absent</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Simple script to set the date picker to today's date
        document.addEventListener('DOMContentLoaded', function() {
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('attendance-date').value = today;
        });
    </script>
</body>
</html>