<?php
include("../config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $age = $_POST['age'];
    $city = $_POST['city'];
    $position = $_POST['position'];
    $salary = $_POST['salary'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    
    $stmt = $con->prepare("UPDATE employees SET first_name=?, last_name=?, age=?, city=?, position=?, salary=?, email=?, phone=? WHERE id=?");
    $stmt->bind_param("ssisssssi", $firstName, $lastName, $age, $city, $position, $salary, $email, $phone, $id);
    
    if ($stmt->execute()) {
        header("Location: all_employees.php?success=updated");
        exit();
    } else {
        header("Location: all_employees.php?error=update_failed");
        exit();
    }
}
?>
