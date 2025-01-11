<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'employee_managements';

// Create MySQLi connection
$conn = new mysqli($host, $user, $pass, $db);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
