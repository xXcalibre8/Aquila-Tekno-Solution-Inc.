<?php
    $con = mysqli_connect("localhost", "root", "", "aquila") or die(mysqli_connect_error());
?>
<?php
$servername = "localhost";
$username = "root";  
$password = "";      
$dbname = "aquila"; 

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
