<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Club Membership Portal</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<header class="site-header">
    <div>
        <h1>Admin Panel</h1>
        <p>Club Membership Portal</p>
    </div>
    <nav>
        <a href="dashboard.php">Dashboard</a>
        <a href="applications.php">Applications</a>
        <a href="members.php">Members</a>
        <a href="logout.php">Logout</a>
    </nav>
</header>
<main class="container">
