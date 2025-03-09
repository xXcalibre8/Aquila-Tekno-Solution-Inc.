<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Departments Dashboard</title>
    <link rel="stylesheet" href="departm.css">
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
    </div>
</body>
</html>