<?php
// Include the database connection file
include '../config.php';

// Fetch appointments data from the database
$appointments = [];
$sql = "SELECT client_id, project_name, appointment_date FROM appointments";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $appointments[] = $row;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="db1.css">
    <link rel="stylesheet" href="dashboard.css">
    <style>
        body {
            display: flex;
        }
        .container {
            display: flex;
        }
        .sidebar {
            width: 250px;
            position: fixed;
            height: 100%;
            background-color: #283a7a;
            color: white;
            padding: 20px;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
            flex-grow: 1;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <h1>
            <img src="../design/aquila.png" alt="Logo">
                AQUILA CORPS
            </h1>
            <a href="dashboard.php"><p>Dashboard</p></a>
            <a href="all_employees.php"><p>Employees</p></a>
            <a href="all_departments.php"><p>Departments</p></a>
            <a href="attendance.php"><p>Attendance</p></a>
            <a href="jobs.php"><p>Jobs</p></a>
            <a href="candidates.php"><p>Candidates</p></a>
            <a href="leaves.php"><p>Leaves</p></a>
            <a href="holidays.php"><p>Holidays</p></a>
            <a href="../login_page.php"><p>Logout</p></a>
        </div>
    </div>

        <div class="content">
            <div class="top-bar">
                <h1>Hello User 👋</h1>
                <div>
                    <span>Bossing | HR Manager</span>
                </div>
            </div>
            <div class="cards">
                <div class="card">
                    <h3>Total Employee</h3>
                    <p>560</p>
                </div>
                <div class="card">
                    <h3>Total Applicant</h3>
                    <p>1050</p>
                </div>
                <div class="card">
                    <h3>Today Attendance</h3>
                    <p>470</p>
                </div>
                <div class="card">
                    <h3>Total Projects</h3>
                    <p>250</p>
                </div>
            </div>
            <div class="schedule">
                <h2>My Schedule</h2>
                <p>Wednesday, July 6, 2023</p>
                <ul>
                    <li>09:30 AM - UI/UX Designer - Practical Task Review</li>
                    <li>12:00 PM - Magento Developer - Resume Review</li>
                </ul>
            </div>
            <div class="attendance">
                <h2>Attendance Overview</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Employee Name</th>
                            <th>Designation</th>
                            <th>Type</th>
                            <th>Check In Time</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Leasie Watson</td>
                            <td>Team Lead - Design</td>
                            <td>Office</td>
                            <td>09:27 AM</td>
                            <td><span class="status on-time">On Time</span></td>
                        </tr>
                        <tr>
                            <td>Darlene Robertson</td>
                            <td>Web Designer</td>
                            <td>Office</td>
                            <td>10:15 AM</td>
                            <td><span class="status late">Late</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="calendar-container">
                <div class="calendar-header">
                    <button id="prevMonth" style="background-color: #283a7a; color: white; border: none; padding: 5px 10px;">&lt;</button>
                    <div id="calendarMonth">November 2024</div>
                    <button id="nextMonth" style="background-color: #283a7a; color: white; border: none; padding: 5px 10px;">&gt;</button>
                </div>
                <div class="calendar-grid" id="calendarGrid">
                    <!-- Days of the Week -->
                    <div class="day-name">Sun</div>
                    <div class="day-name">Mon</div>
                    <div class="day-name">Tue</div>
                    <div class="day-name">Wed</div>
                    <div class="day-name">Thu</div>
                    <div class="day-name">Fri</div>
                    <div class="day-name">Sat</div>
                </div>
            </div>
            <div id="appointmentsModal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h2>Appointments</h2>
                    <ul id="appointmentsList"></ul>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Pass appointments from PHP to JavaScript
        const appointments = <?= json_encode($appointments); ?>;

        // Get elements
        const calendarMonth = document.getElementById('calendarMonth');
        const calendarGrid = document.getElementById('calendarGrid');
        const prevMonthButton = document.getElementById('prevMonth');
        const nextMonthButton = document.getElementById('nextMonth');
        const modal = document.getElementById('appointmentsModal');
        const closeModal = document.querySelector('.close');
        const appointmentsList = document.getElementById('appointmentsList');

        // Initialize current date
        let currentDate = new Date();

        // Function to render the calendar for the given month and year
        function renderCalendar() {
            const month = currentDate.getMonth(); // 0-11
            const year = currentDate.getFullYear();

            // Set month name and year
            const options = { year: 'numeric', month: 'long' };
            calendarMonth.textContent = currentDate.toLocaleDateString('en-US', options);

            // Get the first day of the month and number of days in the month
            const firstDay = new Date(year, month, 1).getDay(); // 0 (Sunday) to 6 (Saturday)
            const lastDate = new Date(year, month + 1, 0).getDate(); // Number of days in the month

            // Clear previous days
            calendarGrid.innerHTML = `
                <div class="day-name">Sun</div>
                <div class="day-name">Mon</div>
                <div class="day-name">Tue</div>
                <div class="day-name">Wed</div>
                <div class="day-name">Thu</div>
                <div class="day-name">Fri</div>
                <div class="day-name">Sat</div>
            `;

            // Add empty divs for the days before the 1st of the month
            for (let i = 0; i < firstDay; i++) {
                const emptyDiv = document.createElement('div');
                calendarGrid.appendChild(emptyDiv);
            }

            // Add the actual days of the month
            for (let day = 1; day <= lastDate; day++) {
                const dayDiv = document.createElement('div');
                dayDiv.classList.add('day');
                dayDiv.textContent = day;

                // Check if this day has any appointments
                const dateStr = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
                const dayAppointments = appointments.filter(appointment => appointment.appointment_date === dateStr);

                if (dayAppointments.length > 0) {
                    dayDiv.classList.add('appointment-day'); // Optional: highlight the day

                    // Add click event to open modal with appointments
                    dayDiv.addEventListener('click', () => showAppointmentsModal(dayAppointments));
                }

                calendarGrid.appendChild(dayDiv);
            }
        }

        // Show the modal with appointments for the clicked day
        function showAppointmentsModal(dayAppointments) {
            appointmentsList.innerHTML = ''; // Clear the existing list
            dayAppointments.forEach(appointment => {
                const listItem = document.createElement('li');
                listItem.textContent = `Client ID: ${appointment.client_id} - Project: ${appointment.project_name} - Date: ${appointment.appointment_date}`;
                appointmentsList.appendChild(listItem);
            });
            modal.style.display = "block";
        }

        // Close the modal
        closeModal.addEventListener('click', () => {
            modal.style.display = "none";
        });

        // Event listeners for buttons to navigate months
        prevMonthButton.addEventListener('click', () => {
            currentDate.setMonth(currentDate.getMonth() - 1);
            renderCalendar();
        });

        nextMonthButton.addEventListener('click', () => {
            currentDate.setMonth(currentDate.getMonth() + 1);
            renderCalendar();
        });

        // Initial render
        renderCalendar();
    </script>
</body>
</html>