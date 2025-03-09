/**
 * Employee Management JavaScript Functions
 */

// DOM Ready event handler
document.addEventListener('DOMContentLoaded', function() {
    // Add form submission handler if the form exists
    const addForm = document.querySelector("#employeeAddForm");
    if (addForm) {
        addForm.addEventListener("submit", function(e) {
            e.preventDefault();
            submitEmployeeForm(this, "add_employee.php");
        });
    }
    
    // Edit form submission handler
    const editForm = document.querySelector("#employeeEditForm");
    if (editForm) {
        editForm.addEventListener("submit", function(e) {
            e.preventDefault();
            submitEmployeeForm(this, "update_employee.php");
        });
    }
    
    // Handle any success or error messages from URL params
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('success')) {
        alert('Operation completed successfully!');
    }
    if (urlParams.has('error')) {
        alert('An error occurred: ' + urlParams.get('error'));
    }
});

/**
 * Submit employee form with fetch API
 * @param {HTMLFormElement} form - The form element
 * @param {string} endpoint - API endpoint URL
 */
function submitEmployeeForm(form, endpoint) {
    const formData = new FormData(form);
    
    fetch(endpoint, {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.message);
            location.reload();
        } else {
            alert(data.message || 'An error occurred');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Failed to process request');
    });
}

/**
 * Open edit employee popup and populate form
 */
function openEditEmployeePopup(id, firstName, lastName, age, city, position, salary, email, phone) {
    const popup = document.getElementById('editEmployeePopup');
    if (popup) {
        popup.style.display = 'flex';
        document.getElementById('editId').value = id;
        document.getElementById('editFName').value = firstName;
        document.getElementById('editLName').value = lastName;
        document.getElementById('editAge').value = age;
        document.getElementById('editCity').value = city;
        document.getElementById('editPosition').value = position;
        document.getElementById('editSalary').value = salary;
        document.getElementById('editEmail').value = email;
        document.getElementById('editPhone').value = phone;
    } else {
        console.error('Edit popup element not found');
    }
}

/**
 * Close edit employee popup
 */
function closeEditEmployeePopup() {
    const popup = document.getElementById('editEmployeePopup');
    if (popup) popup.style.display = 'none';
}

/**
 * Open add employee popup
 */
function openAddEmployeePopup() {
    const popup = document.getElementById('addEmployeePopup');
    if (popup) {
        popup.style.display = 'flex';
    } else {
        console.error('Add popup element not found');
    }
}

/**
 * Close add employee popup
 */
function closeAddEmployeePopup() {
    const popup = document.getElementById('addEmployeePopup');
    if (popup) popup.style.display = 'none';
}

/**
 * Clear search and redirect to main page
 */
function clearSearch() {
    window.location.href = 'all_employees.php';
}

/**
 * Close popups when clicking outside
 */
window.onclick = function(event) {
    if (event.target.className === 'dark_bg') {
        event.target.style.display = 'none';
    }
};
