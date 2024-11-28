<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Departments Dashboard</title>

    <link rel="stylesheet" href="departments.css">
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
            width: calc(100% - 250px);
            padding: 20px;
            height: 100vh;
            background-color: #2e3859;
            overflow: auto;
        }

        .header {
            background-color: #1e293b;
            border-bottom: 1px solid #334155;
            padding: 16px;
        }

        .header .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h1 {
            font-size: 1.25rem;
            font-weight: 600;
            margin: 0;
        }

        .header .breadcrumb {
            font-size: 0.875rem;
            color: #94a3b8;
        }

        .header .breadcrumb a {
            color: #94a3b8;
            text-decoration: none;
        }

        .header .breadcrumb a:hover {
            color: #cbd5e1;
        }

        .header .notification-button {
            background: none;
            border: none;
            color: #94a3b8;
            cursor: pointer;
            font-size: 1.25rem;
        }

        .header .notification-button:hover {
            color: #cbd5e1;
        }

        .grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 24px;
        }

        @media (min-width: 768px) {
            .grid {
                grid-template-columns: 1fr 1fr;
            }
        }

        .card {
            background-color: #1e293b;
            border: 1px solid #334155;
            border-radius: 8px;
            padding: 16px;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 8px;
            border-bottom: 1px solid #334155;
        }

        .card-title {
            font-size: 1rem;
            font-weight: 500;
            margin: 0;
        }

        .card-title .member-count {
            font-size: 0.875rem;
            color: #94a3b8;
        }

        .view-all-button {
            background: none;
            border: none;
            color: #3b82f6;
            cursor: pointer;
            font-size: 0.875rem;
        }

        .view-all-button:hover {
            color: #2563eb;
        }

        .card-content {
            padding-top: 16px;
        }

        .member {
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            padding: 8px 0;
        }

        .member:hover .chevron {
            opacity: 1;
        }

        .member-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background-color: #334155;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.875rem;
            color: #cbd5e1;
        }

        .member-name {
            font-size: 0.875rem;
            font-weight: 500;
            margin: 0;
        }

        .member-role {
            font-size: 0.75rem;
            color: #94a3b8;
            margin: 0;
        }

        .chevron {
            font-size: 1rem;
            color: #475569;
            opacity: 0;
            transition: opacity 0.3s;
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

<!-- Header -->
<header class="header">
    <div class="container">
        <div class="header-content">
            <div>
                <h1>Demon Lord</h1>
                <div class="breadcrumb">
                    <a href="#">All Employees</a> &gt; Demon Lord
                </div>
            </div>
            <button class="notification-button">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405 1.405A2.032 2.032 0 0118 20H6c-.379 0-.725-.214-.895-.553L4 18H9m0 0a3 3 0 00-3-3H4a3 3 0 00-3 3v3m6 0h6" />
                </svg>
            </button>
        </div>
    </div>
</header>

<!-- Main Content -->
<main class="main-content">
    <div class="grid">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    Design Department
                    <div class="member-count">20 Members</div>
                </div>
                <button class="view-all-button">View All</button>
            </div>
            <div class="card-content">
                <div class="member">
                    <div class="member-info">
                        <div class="avatar">DR</div>
                        <div>
                            <div class="member-name">Dianne Russell</div>
                            <div class="member-role">Lead UI/UX Designer</div>
                        </div>
                    </div>
                    <div class="chevron">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                </div>
                <div class="member">
                    <div class="member-info">
                        <div class="avatar">AM</div>
                        <div>
                            <div class="member-name">Arlene McCoy</div>
                            <div class="member-role">Sr UI/UX Designer</div>
                        </div>
                    </div>
                    <div class="chevron">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                </div>
                <!-- Repeat for other members -->
            </div>
        </div>
        <!-- Repeat for other cards -->

        <!-- Marketing Department -->
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    Marketing Department
                    <div class="member-count">15 Members</div>
                </div>
                <button class="view-all-button">View All</button>
            </div>
            <div class="card-content">
                <div class="member">
                    <div class="member-info">
                        <div class="avatar">JS</div>
                        <div>
                            <div class="member-name">John Smith</div>
                            <div class="member-role">Marketing Manager</div>
                        </div>
                    </div>
                    <div class="chevron">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                </div>
                <div class="member">
                    <div class="member-info">
                        <div class="avatar">LB</div>
                        <div>
                            <div class="member-name">Linda Brown</div>
                            <div class="member-role">Content Strategist</div>
                        </div>
                    </div>
                    <div class="chevron">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                </div>
                <!-- Repeat for other members -->
            </div>
        </div>

        <!-- IT Department -->
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    IT Department
                    <div class="member-count">25 Members</div>
                </div>
                <button class="view-all-button">View All</button>
            </div>
            <div class="card-content">
                <div class="member">
                    <div class="member-info">
                        <div class="avatar">MK</div>
                        <div>
                            <div class="member-name">Michael King</div>
                            <div class="member-role">IT Manager</div>
                        </div>
                    </div>
                    <div class="chevron">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                </div>
                <div class="member">
                    <div class="member-info">
                        <div class="avatar">SR</div>
                        <div>
                            <div class="member-name">Sarah Robinson</div>
                            <div class="member-role">System Administrator</div>
                        </div>
                    </div>
                    <div class="chevron">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                </div>
                <!-- Repeat for other members -->
            </div>
        </div>

        <!-- HR Department -->
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    HR Department
                    <div class="member-count">10 Members</div>
                </div>
                <button class="view-all-button">View All</button>
            </div>
            <div class="card-content">
                <div class="member">
                    <div class="member-info">
                        <div class="avatar">JD</div>
                        <div>
                            <div class="member-name">Jane Doe</div>
                            <div class="member-role">HR Manager</div>
                        </div>
                    </div>
                    <div class="chevron">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                </div>
                <div class="member">
                    <div class="member-info">
                        <div class="avatar">RB</div>
                        <div>
                            <div class="member-name">Robert Brown</div>
                            <div class="member-role">Recruiter</div>
                        </div>
                    </div>
                    <div class="chevron">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                </div>
                <!-- Repeat for other members -->
            </div>
        </div>

        <!-- Finance Department -->
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    Finance Department
                    <div class="member-count">12 Members</div>
                </div>
                <button class="view-all-button">View All</button>
            </div>
            <div class="card-content">
                <div class="member">
                    <div class="member-info">
                        <div class="avatar">SM</div>
                        <div>
                            <div class="member-name">Sam Miller</div>
                            <div class="member-role">Finance Manager</div>
                        </div>
                    </div>
                    <div class="chevron">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                </div>
                <div class="member">
                    <div class="member-info">
                        <div class="avatar">KT</div>
                        <div>
                            <div class="member-name">Kate Turner</div>
                            <div class="member-role">Accountant</div>
                        </div>
                    </div>
                    <div class="chevron">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                </div>
                <!-- Repeat for other members -->
            </div>
        </div>

        <!-- Sales Department -->
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    Sales Department
                    <div class="member-count">18 Members</div>
                </div>
                <button class="view-all-button">View All</button>
            </div>
            <div class="card-content">
                <div class="member">
                    <div class="member-info">
                        <div class="avatar">JW</div>
                        <div>
                            <div class="member-name">John White</div>
                            <div class="member-role">Sales Manager</div>
                        </div>
                    </div>
                    <div class="chevron">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                </div>
                <div class="member">
                    <div class="member-info">
                        <div class="avatar">MB</div>
                        <div>
                            <div class="member-name">Mary Black</div>
                            <div class="member-role">Sales Executive</div>
                        </div>
                    </div>
                    <div class="chevron">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                </div>
                <!-- Repeat for other members -->
            </div>
        </div>
    </div>
</main>

</body>
</html>