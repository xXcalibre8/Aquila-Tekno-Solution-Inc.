<?php
// Include the database connection file
session_start();
include '../config.php';

if (!isset($_SESSION['id'])) {
    header("Location: login_page.php");
    exit();
}

if ($_SESSION['roles'] !== 'admin') {
    header("Location: login_page.php");
    exit();
}

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
    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <div class="container">
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

        <main class="main-content">
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
                    <button id="prevMonth"><i class="fas fa-chevron-left"></i></button>
                    <div id="calendarMonth"></div>
                    <button id="nextMonth"><i class="fas fa-chevron-right"></i></button>
                </div>
                <div class="calendar-weekdays">
                    <div>Sun</div>
                    <div>Mon</div>
                    <div>Tue</div>
                    <div>Wed</div>
                    <div>Thu</div>
                    <div>Fri</div>
                    <div>Sat</div>
                </div>
                <div class="calendar-grid" id="calendarGrid"></div>
            </div>

            <!-- Calendar Modal -->
            <div id="appointmentModal" class="modal">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2>Appointments for <span id="modalDate"></span></h2>
                        <span class="close">&times;</span>
                    </div>
                    <div class="modal-body">
                        <ul id="appointmentsList"></ul>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script>
        // Pass appointments from PHP to JavaScript
        const appointments = <?= json_encode($appointments); ?>;

        // Get elements
        const calendarMonth = document.getElementById('calendarMonth');
        const calendarGrid = document.getElementById('calendarGrid');
        const modal = document.getElementById('appointmentModal');
        const modalDate = document.getElementById('modalDate');
        const closeBtn = document.querySelector('.close');
        let currentDate = new Date();

        function renderCalendar() {
            const year = currentDate.getFullYear();
            const month = currentDate.getMonth();

            // Update header with month and year
            calendarMonth.textContent = currentDate.toLocaleDateString('en-US', {
                month: 'long',
                year: 'numeric'
            });

            // Clear grid first
            calendarGrid.innerHTML = '';

            // Add weekday headers
            const weekdays = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
            weekdays.forEach(day => {
                const dayDiv = document.createElement('div');
                dayDiv.className = 'day-name';
                dayDiv.textContent = day;
                calendarGrid.appendChild(dayDiv);
            });

            // Get first day and last day of month
            const firstDay = new Date(year, month, 1).getDay();
            const lastDate = new Date(year, month + 1, 0).getDate();
            const today = new Date();

            // Add empty cells for days before start of month
            for (let i = 0; i < firstDay; i++) {
                const emptyDiv = document.createElement('div');
                emptyDiv.className = 'day empty';
                calendarGrid.appendChild(emptyDiv);
            }

            // Add days of the month
            for (let date = 1; date <= lastDate; date++) {
                const dayDiv = document.createElement('div');
                dayDiv.className = 'day';
                dayDiv.textContent = date;

                // Highlight today
                if (year === today.getFullYear() && 
                    month === today.getMonth() && 
                    date === today.getDate()) {
                    dayDiv.classList.add('today');
                }

                // Check for appointments
                const dateStr = `${year}-${String(month + 1).padStart(2, '0')}-${String(date).padStart(2, '0')}`;
                const dayAppointments = appointments.filter(apt => apt.appointment_date === dateStr);

                if (dayAppointments.length > 0) {
                    dayDiv.classList.add('appointment-day');
                    dayDiv.addEventListener('click', () => {
                        showAppointments(dateStr, dayAppointments);
                    });
                }

                calendarGrid.appendChild(dayDiv);
            }
        }

        function showAppointments(date, appointments) {
            modalDate.textContent = new Date(date).toLocaleDateString('en-US', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });

            const appointmentsList = document.getElementById('appointmentsList');
            appointmentsList.innerHTML = appointments.map(apt => `
                <li>
                    <strong>${apt.project_name}</strong><br>
                    Client ID: ${apt.client_id}
                </li>
            `).join('');

            modal.style.display = 'block';
        }

        // Event Listeners
        document.getElementById('prevMonth').addEventListener('click', () => {
            currentDate.setMonth(currentDate.getMonth() - 1);
            renderCalendar();
        });

        document.getElementById('nextMonth').addEventListener('click', () => {
            currentDate.setMonth(currentDate.getMonth() + 1);
            renderCalendar();
        });

        closeBtn.addEventListener('click', () => {
            modal.style.display = 'none';
        });

        window.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.style.display = 'none';
            }
        });

        // Initial render
        renderCalendar();
    </script>
</body>
</html>