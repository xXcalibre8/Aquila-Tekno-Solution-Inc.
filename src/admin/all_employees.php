<?php
// Include database connection
include("../config.php");

// Check if connection is successful
if (!isset($con) || $con->connect_error) {
    die("Connection failed: " . ($con->connect_error ?? "Database connection variable not defined"));
}

// Check if there is a search query
$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';

// Prepare SQL query with search functionality
if (!empty($searchQuery)) {
    // Using CONCAT to match first name and last name as a single string for full name search
    $stmt = $con->prepare("SELECT * FROM employees WHERE CONCAT(first_name, ' ', last_name) LIKE ?");
    $searchTerm = '%' . $searchQuery . '%';
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    // Default query to select all employees if no search term is provided
    $result = $con->query("SELECT * FROM employees");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employees - AQUILA CORPS</title>
    <link rel="stylesheet" href="employee.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="all_employee.js"></script>
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

        <!-- Change main content structure with unique class names -->
        <div class="employee-main-content">
            <div class="employee-page-header">
                <h1>Employees</h1>
            </div>
            
            <div class="employee-content-wrapper">
                <header class="employee-table-header">
                    <div class="employee-filter">
                        <div class="entry-select">
                            Show 
                            <select id="table_size">
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select> 
                            entries
                        </div>
                        <div class="employee-search">
                            <form action="all_employees.php" method="get" id="searchForm">
                                <label for="search">Search Employee:</label>
                                <input type="search" id="search" name="search" placeholder="Enter full name" value="<?php echo htmlspecialchars($searchQuery); ?>">
                                <button type="submit" class="search-btn">Search</button>
                                <button type="button" class="cancel-btn" onclick="clearSearch()">Cancel</button>
                            </form>
                        </div>
                    </div>
                    <div class="add-employee-btn">
                        <button onclick="openAddEmployeePopup()" class="add-btn">Add Employee</button>
                    </div>
                </header>

                <div class="employee-table">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Age</th>
                                <th>City</th>
                                <th>Position</th>
                                <th>Salary</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['first_name'] . ' ' . $row['last_name']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['age']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['city']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['position']) . "</td>";
                                    echo "<td>$" . htmlspecialchars($row['salary']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['phone']) . "</td>";
                                    echo "<td>
                                        <button onclick=\"openEditEmployeePopup('" . $row['id'] . "', '" . $row['first_name'] . "', '" . $row['last_name'] . "', '" . $row['age'] . "', '" . $row['city'] . "', '" . $row['position'] . "', '" . $row['salary'] . "', '" . $row['email'] . "', '" . $row['phone'] . "')\">Edit</button>
                                        <button onclick=\"if(confirm('Are you sure you want to delete this employee?')) window.location.href='delete_employee.php?id=" . $row['id'] . "'\">Delete</button>
                                    </td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='9'>No employees found</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Employee Popup -->
    <div class="dark_bg" id="editEmployeePopup">
        <div class="popup">
            <header>
                <h2>Edit Employee</h2>
                <button onclick="closeEditEmployeePopup()" class="close-btn">&times;</button>
            </header>
            <div class="body">
                <form action="update_employee.php" method="post">
                    <input type="hidden" id="editId" name="id">
                    <div class="form_control">
                        <label for="editFName">First Name</label>
                        <input type="text" id="editFName" name="first_name" required>
                    </div>
                    <div class="form_control">
                        <label for="editLName">Last Name</label>
                        <input type="text" id="editLName" name="last_name" required>
                    </div>
                    <div class="form_control">
                        <label for="editAge">Age</label>
                        <input type="number" id="editAge" name="age" required>
                    </div>
                    <div class="form_control">
                        <label for="editCity">City</label>
                        <input type="text" id="editCity" name="city" required>
                    </div>
                    <div class="form_control">
                        <label for="editPosition">Position</label>
                        <input type="text" id="editPosition" name="position" required>
                    </div>
                    <div class="form_control">
                        <label for="editSalary">Salary</label>
                        <input type="number" id="editSalary" name="salary" required>
                    </div>
                    <div class="form_control">
                        <label for="editEmail">Email</label>
                        <input type="email" id="editEmail" name="email" required>
                    </div>
                    <div class="form_control">
                        <label for="editPhone">Phone</label>
                        <input type="text" id="editPhone" name="phone" required>
                    </div>
                    <button type="submit" class="submitBtn">Update Employee</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Add Employee Popup -->
    <div class="dark_bg" id="addEmployeePopup">
        <div class="popup">
            <header>
                <h2>Add New Employee</h2>
                <button onclick="closeAddEmployeePopup()" class="close-btn">&times;</button>
            </header>
            <div class="body">
                <form action="add_employee.php" method="post">
                    <div class="form_control">
                        <label for="firstName">First Name</label>
                        <input type="text" id="firstName" name="first_name" required>
                    </div>
                    <div class="form_control">
                        <label for="lastName">Last Name</label>
                        <input type="text" id="lastName" name="last_name" required>
                    </div>
                    <div class="form_control">
                        <label for="age">Age</label>
                        <input type="number" id="age" name="age" required>
                    </div>
                    <div class="form_control">
                        <label for="city">City</label>
                        <input type="text" id="city" name="city" required>
                    </div>
                    <div class="form_control">
                        <label for="position">Position</label>
                        <input type="text" id="position" name="position" required>
                    </div>
                    <div class="form_control">
                        <label for="salary">Salary</label>
                        <input type="number" id="salary" name="salary" required>
                    </div>
                    <div class="form_control">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form_control">
                        <label for="phone">Phone</label>
                        <input type="text" id="phone" name="phone" required>
                    </div>
                    <button type="submit" class="submitBtn">Add Employee</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Add this script at the bottom of your file, just before closing </body> tag -->
    <script>
        // Popup functions
        function openEditEmployeePopup(id, firstName, lastName, age, city, position, salary, email, phone) {
            document.getElementById('editEmployeePopup').style.display = 'flex';
            document.getElementById('editId').value = id;
            document.getElementById('editFName').value = firstName;
            document.getElementById('editLName').value = lastName;
            document.getElementById('editAge').value = age;
            document.getElementById('editCity').value = city;
            document.getElementById('editPosition').value = position;
            document.getElementById('editSalary').value = salary;
            document.getElementById('editEmail').value = email;
            document.getElementById('editPhone').value = phone;
        }

        function closeEditEmployeePopup() {
            document.getElementById('editEmployeePopup').style.display = 'none';
        }

        function openAddEmployeePopup() {
            console.log('Opening add employee popup');
            const popup = document.getElementById('addEmployeePopup');
            console.log('Popup element:', popup);
            popup.style.display = 'flex';
        }

        function closeAddEmployeePopup() {
            document.getElementById('addEmployeePopup').style.display = 'none';
        }

        // Fixed clearSearch function
        function clearSearch() {
            // Clear the search input
            document.getElementById('search').value = '';
            // Submit the form with empty search value
            document.getElementById('searchForm').submit();
        }

        // Close popups when clicking outside
        window.onclick = function(event) {
            if (event.target.className === 'dark_bg') {
                event.target.style.display = 'none';
            }
        }

        // Initialize any necessary functionality
        document.addEventListener('DOMContentLoaded', function() {
            // Handle any success or error messages
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('success')) {
                alert('Operation completed successfully!');
            }
            if (urlParams.has('error')) {
                alert('An error occurred: ' + urlParams.get('error'));
            }
        });
    </script>
</body>
</html>