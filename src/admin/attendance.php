<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AQUILA CORPS Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="attendance.css">
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            overflow: hidden;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #283a7a;
            color: white;
            padding: 20px;
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            flex-direction: column;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.5);
        }

        .sidebar h1 {
            margin-bottom: 20px;
            font-size: 1.5em;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .sidebar h1 img {
            width: 50px;
            height: auto;
        }

        .sidebar a {
            text-decoration: none;
            color: inherit;
        }

        .sidebar p {
            margin: 15px 0;
            cursor: pointer;
        }

        /* Main Content */
        .main-content {
            margin-left: 250px;
            width: 100%;
            padding: 20px;
            height: 100vh;
            background-color: #2e3859;
            overflow: auto;
        }

        /* Calendar Styles */
        .calendar-container {
            max-width: 600px;
            margin: auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }

        .calendar-header {
            background-color: #283a7a;
            color: #ffffff;
            text-align: center;
            padding: 15px;
            font-size: 1.2em;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            padding: 20px;
            gap: 5px;
            font-size: 0.9em;
            text-align: center;
        }

        .day-name, .day {
            padding: 10px;
            border-radius: 4px;
        }

        .day-name {
            font-weight: bold;
            color: #283a7a;
        }

        .day {
            background-color: #f0f4ff;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 50px; /* Adjust the height for proper visibility */
        }

        .day:hover {
            background-color: #d2e2ff;
        }

        /* Days of the week */
        .day-name:nth-child(1), .day:nth-child(7n+1) {
            color: #d9534f;
        }

        .day-name:nth-child(7), .day:nth-child(7n) {
            color: #5bc0de;
        }

    </style>
</head>
<body>

<!-- Sidebar -->
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

<!-- Main Content -->
<div class="main-content">
    <div class="header">
        <h1>Demon Lord</h1>
        <div class="user-info">
            <div class="avatar"></div>
            <span>Bossing</span>
        </div>
    </div>

    <div class="search-and-filter">
        <div class="search-bar">
            <input type="text" placeholder="Search" class="search-input">
        </div>
        <div class="filter">
            <span>Showing</span>
            <select class="filter-select">
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="50">50</option>
            </select>
        </div>
    </div>

    <div class="table-container">
        <table class="employee-table">
            <thead>
                <tr>
                    <th>Employee Name</th>
                    <th>Employee ID</th>
                    <th>Department</th>
                    <th>Designation</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- Replace with your dynamic content -->
                <tr>
                    <td><div class="employee-name"><div class="avatar"></div><span>Darlene Robertson</span></div></td>
                    <td>345321231</td>
                    <td>Design</td>
                    <td>UI/UX Designer</td>
                    <td>Office</td>
                    <td><span class="status permanent">Permanent</span></td>
                    <td>
                        <div class="actions">
                            <button class="action-btn view">View</button>
                            <button class="action-btn edit">Edit</button>
                            <button class="action-btn delete">Delete</button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><div class="employee-name"><div class="avatar"></div><span>Darlene Robertson</span></div></td>
                    <td>345321231</td>
                    <td>Design</td>
                    <td>UI/UX Designer</td>
                    <td>Office</td>
                    <td><span class="status permanent">Permanent</span></td>
                    <td>
                        <div class="actions">
                            <button class="action-btn view">View</button>
                            <button class="action-btn edit">Edit</button>
                            <button class="action-btn delete">Delete</button>
                        </div>
                    </td>
                </tr><tr>
                    <td><div class="employee-name"><div class="avatar"></div><span>Darlene Robertson</span></div></td>
                    <td>345321231</td>
                    <td>Design</td>
                    <td>UI/UX Designer</td>
                    <td>Office</td>
                    <td><span class="status permanent">Permanent</span></td>
                    <td>
                        <div class="actions">
                            <button class="action-btn view">View</button>
                            <button class="action-btn edit">Edit</button>
                            <button class="action-btn delete">Delete</button>
                        </div>
                    </td>
                </tr><tr>
                    <td><div class="employee-name"><div class="avatar"></div><span>Darlene Robertson</span></div></td>
                    <td>345321231</td>
                    <td>Design</td>
                    <td>UI/UX Designer</td>
                    <td>Office</td>
                    <td><span class="status permanent">Permanent</span></td>
                    <td>
                        <div class="actions">
                            <button class="action-btn view">View</button>
                            <button class="action-btn edit">Edit</button>
                            <button class="action-btn delete">Delete</button>
                        </div>
                    </td>
                </tr><tr>
                    <td><div class="employee-name"><div class="avatar"></div><span>Darlene Robertson</span></div></td>
                    <td>345321231</td>
                    <td>Design</td>
                    <td>UI/UX Designer</td>
                    <td>Office</td>
                    <td><span class="status permanent">Permanent</span></td>
                    <td>
                        <div class="actions">
                            <button class="action-btn view">View</button>
                            <button class="action-btn edit">Edit</button>
                            <button class="action-btn delete">Delete</button>
                        </div>
                    </td>
                </tr><tr>
                    <td><div class="employee-name"><div class="avatar"></div><span>Darlene Robertson</span></div></td>
                    <td>345321231</td>
                    <td>Design</td>
                    <td>UI/UX Designer</td>
                    <td>Office</td>
                    <td><span class="status permanent">Permanent</span></td>
                    <td>
                        <div class="actions">
                            <button class="action-btn view">View</button>
                            <button class="action-btn edit">Edit</button>
                            <button class="action-btn delete">Delete</button>
                        </div>
                    </td>
                </tr><tr>
                    <td><div class="employee-name"><div class="avatar"></div><span>Darlene Robertson</span></div></td>
                    <td>345321231</td>
                    <td>Design</td>
                    <td>UI/UX Designer</td>
                    <td>Office</td>
                    <td><span class="status permanent">Permanent</span></td>
                    <td>
                        <div class="actions">
                            <button class="action-btn view">View</button>
                            <button class="action-btn edit">Edit</button>
                            <button class="action-btn delete">Delete</button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><div class="employee-name"><div class="avatar"></div><span>Darlene Robertson</span></div></td>
                    <td>345321231</td>
                    <td>Design</td>
                    <td>UI/UX Designer</td>
                    <td>Office</td>
                    <td><span class="status permanent">Permanent</span></td>
                    <td>
                        <div class="actions">
                            <button class="action-btn view">View</button>
                            <button class="action-btn edit">Edit</button>
                            <button class="action-btn delete">Delete</button>
                        </div>
                    </td>
                </tr><tr>
                    <td><div class="employee-name"><div class="avatar"></div><span>Darlene Robertson</span></div></td>
                    <td>345321231</td>
                    <td>Design</td>
                    <td>UI/UX Designer</td>
                    <td>Office</td>
                    <td><span class="status permanent">Permanent</span></td>
                    <td>
                        <div class="actions">
                            <button class="action-btn view">View</button>
                            <button class="action-btn edit">Edit</button>
                            <button class="action-btn delete">Delete</button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="pagination">
        <span>Showing 1 to 10 out of 40 records</span>
        <div class="pagination-buttons">
            <button class="pagination-btn">Previous</button>
            <button class="pagination-btn">1</button>
            <button class="pagination-btn">2</button>
            <button class="pagination-btn">3</button>
            <button class="pagination-btn">Next</button>
        </div>
    </div>
</div>

<script>
    // Get elements
    const calendarMonth = document.getElementById('calendarMonth');
    const calendarGrid = document.getElementById('calendarGrid');
    const prevMonthButton = document.getElementById('prevMonth');
    const nextMonthButton = document.getElementById('nextMonth');

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
            calendarGrid.appendChild(dayDiv);
        }
    }

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