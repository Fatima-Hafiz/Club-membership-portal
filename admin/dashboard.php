<?php
include 'auth.php';
include '../includes/db.php';

function getCount($conn, $status = null) {
    if ($status == null) {
        $sql = "SELECT COUNT(*) AS total FROM applications";
        $result = mysqli_query($conn, $sql);
    } else {
        $sql = "SELECT COUNT(*) AS total FROM applications WHERE Status = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $status);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
    }

    $row = mysqli_fetch_assoc($result);
    return $row["total"];
}

$total = getCount($conn);
$pending = getCount($conn, "Pending");
$approved = getCount($conn, "Approved");
$rejected = getCount($conn, "Rejected");
?>

<?php include 'header.php'; ?>

<section class="card">
    <h2>Dashboard</h2>
    <p>Welcome, <?php echo htmlspecialchars($_SESSION["admin_username"]); ?>. This page shows a summary of club applications.</p>
</section>

<section class="dashboard-grid">
    <div class="stat-box">
        <h3><?php echo $total; ?></h3>
        <p>Total Applications</p>
    </div>
    <div class="stat-box">
        <h3><?php echo $pending; ?></h3>
        <p>Pending</p>
    </div>
    <div class="stat-box">
        <h3><?php echo $approved; ?></h3>
        <p>Approved</p>
    </div>
    <div class="stat-box">
        <h3><?php echo $rejected; ?></h3>
        <p>Rejected</p>
    </div>
</section>

<section class="card">
    <a class="btn" href="applications.php">View Applications</a>
    <a class="btn btn-secondary" href="members.php">View Members</a>
</section>

<?php include 'footer.php'; ?>
