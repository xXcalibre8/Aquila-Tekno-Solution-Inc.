<?php

include "../config.php";
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'client') {
    header("Location: login_page.php");
    exit();
} 

function getAppointments() {
    global $conn;
    $clientId = $_SESSION['username'];
    $sql = "SELECT client_id, project_name, appointment_date FROM appointments WHERE client_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $clientId);  // Changed "i" to "s"
    $stmt->execute();
    $result = $stmt->get_result();
    return $result;
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $projectName = $_POST["projectName"];
    $appointmentDate = $_POST["appointmentDate"];
    $clientId = $_SESSION['username']; // Assuming you store user IDs in the session

    // Prepare and execute SQL statement
    $sql = "INSERT INTO appointments (client_id, project_name, appointment_date, created_at) 
            VALUES (?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $clientId, $projectName, $appointmentDate);  // Changed "iss" to "sss"

    if ($stmt->execute()) {
        echo "New appointment scheduled successfully";
        header("Location: scheduling.php");
        exit();
    } else {
        echo "Error: {$sql}<br>{$conn->error}";
    }
    $stmt->close();

    echo "<script>alert('SQL Query: $sql');</script>";
}

// Handle appointment deletion (if needed)
if (isset($_GET['delete_username'])) {
    $deleteId = $_GET['delete_username'];
    $sql = "DELETE FROM appointments WHERE client_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $deleteId);  // Changed "i" to "s"

    if ($stmt->execute()) {
        // Deletion successful
    } else {
        // Handle deletion error
    }

    // After deletion, refresh the appointment list
    header("Location: scheduling.php"); 
    exit(); 
}

// User is authorized as a client - display the client dashboard content
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Scheduling</title>
  <link rel="stylesheet" href="style2.css">
</head>
<body>
  <div class="container">
    <!-- Sidebar -->
    <div class="sidebar">
      <img src="IMG/aquila.png" alt="Logo">
      <h2>AQUILA CORPS</h2>
      <a href="clientdashb.php" class="nav-link" id="dashboard-link">Dashboard</a>
      <a href="scheduling.php" class="nav-link" id="scheduling-link">Scheduling</a>
      <a href="payment.php" class="nav-link" id="payment-link">Payment</a>
      <a href="login_page.php" class="nav-link" id="settings-link">Logout</a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
      <div class="header">
        <h1>Scheduling</h1>
        <p>Manage your project schedules here.</p>
      </div>

      <div class="content-section">
        <div class="schedule-button-container">
          <button id="scheduleBtn">Schedule</button> <!-- Schedule Button -->
          
          <h3>Upcoming Appointments</h3>
          <ul id="appointmentsList" class="appointments-list">
            <!-- Appointments will be populated here -->
            <?php
            $appointmentsResult = getAppointments();
            if ($appointmentsResult->num_rows > 0) {
                while ($row = $appointmentsResult->fetch_assoc()) {
                    echo '<li class="appointment-item">';
                    echo $row["project_name"] . " - " . date("F j, Y", strtotime($row["appointment_date"]));
                    echo ' <button class="deleteBtn" onclick="deleteAppointment(' . $row["client_id"] . ')">Delete</button>';
                    echo '</li>';
                }
            } else {
                echo '<li>No appointments scheduled yet.</li>';
            }
            ?>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal for Schedule Form -->
  <div id="scheduleModal" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <h3>Schedule a Project</h3>
      <form id="scheduleForm" action="scheduling.php" method="POST"> 
          <label for="projectName">Project Name:</label><br>
          <input type="text" id="projectName" name="projectName" required><br><br>

          <label for="appointmentDate">Select Date:</label><br>
          <input type="date" id="appointmentDate" name="appointmentDate" required><br><br>

          <button type="submit" id="submitSchedule">Submit</button>
      </form>
    </div>
  </div>

  <script>
    // Modal functionality
    const scheduleBtn = document.getElementById("scheduleBtn");
    const scheduleModal = document.getElementById("scheduleModal");
    const closeBtn = document.getElementsByClassName("close")[0];
    
    // Show the modal when the "Schedule" button is clicked
    scheduleBtn.onclick = function() {
      scheduleModal.style.display = "block";
    };

    // Close the modal when the close button (x) is clicked
    closeBtn.onclick = function() {
      scheduleModal.style.display = "none";
    };

    // Close the modal when clicking outside of the modal
    window.onclick = function(event) {
      if (event.target == scheduleModal) {
        scheduleModal.style.display = "none";
      }
    };

    function deleteAppointment(appointmentId) {
        if (confirm("Are you sure you want to delete this appointment?")) {
            // AJAX call to delete from the database
            const xhr = new XMLHttpRequest();
            xhr.open("GET", `scheduling.php?delete_username=${appointmentId}`, true);
            xhr.onload = function() {
                if (this.status == 200) {
                    // Remove the appointment from the list visually
                    const listItem = document.querySelector(`.appointment-item:has(button[onclick="deleteAppointment(${appointmentId})"])`);
                    listItem.remove();
                } else {
                    // Handle error
                    console.error("Error deleting appointment");
                }
            };
            xhr.send();
        }
    }
  </script>
</body>
</html>

<?php
$conn->close(); // Close the connection AFTER all HTML output and database operations
?>
