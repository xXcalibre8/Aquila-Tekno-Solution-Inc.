<?php
include("../config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $age = $_POST['age'];
    $city = $_POST['city'];
    $position = $_POST['position'];
    $salary = $_POST['salary'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    
    $stmt = $con->prepare("INSERT INTO employees (first_name, last_name, age, city, position, salary, email, phone) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssississs", $firstName, $lastName, $age, $city, $position, $salary, $email, $phone);
    
    if ($stmt->execute()) {
        header("Location: all_employees.php?success=added");
        exit();
    } else {
        header("Location: all_employees.php?error=add_failed");
        exit();
    }
}
?>
