<?php
$conn = new mysqli('localhost', 'root', '', 'blood_system');
if ($conn->connect_error) {
    die("Database connection failed!");
}
?>
