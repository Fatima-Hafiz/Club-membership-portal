<?php
// Database connection file
// Change these values only if your XAMPP MySQL settings are different.

$host = "localhost";
$user = "root";
$password = "";
$database = "club_portal";

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>
