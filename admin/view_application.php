<?php
include 'auth.php';
include '../includes/db.php';

$message = "";

if (!isset($_GET["id"])) {
    header("Location: applications.php");
    exit();
}

$applicationID = intval($_GET["id"]);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newStatus = $_POST["status"];

    if ($newStatus == "Approved" || $newStatus == "Rejected" || $newStatus == "Pending") {
        $sql = "UPDATE applications SET Status = ? WHERE ApplicationID = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "si", $newStatus, $applicationID);

        if (mysqli_stmt_execute($stmt)) {
            $message = "Application status updated successfully.";
        } else {
            $message = "Error updating status.";
        }
    }
}

$sql = "SELECT * FROM applications WHERE ApplicationID = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $applicationID);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) == 0) {
    header("Location: applications.php");
    exit();
}

$app = mysqli_fetch_assoc($result);
?>

<?php include 'header.php'; ?>

<section class="card">
    <h2>Application Details</h2>

    <?php if ($message != ""): ?>
        <div class="message-success"><p><?php echo htmlspecialchars($message); ?></p></div>
    <?php endif; ?>

    <p><strong>Application ID:</strong> <?php echo $app["ApplicationID"]; ?></p>
    <p><strong>Full Name:</strong> <?php echo htmlspecialchars($app["FullName"]); ?></p>
    <p><strong>Student ID:</strong> <?php echo htmlspecialchars($app["StudentID"]); ?></p>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($app["Email"]); ?></p>
    <p><strong>Phone:</strong> <?php echo htmlspecialchars($app["Phone"]); ?></p>
    <p><strong>Programme:</strong> <?php echo htmlspecialchars($app["Programme"]); ?></p>
    <p><strong>Level:</strong> <?php echo htmlspecialchars($app["Level"]); ?></p>
    <p><strong>Club:</strong> <?php echo htmlspecialchars($app["ClubName"]); ?></p>
    <p><strong>Reason:</strong> <?php echo nl2br(htmlspecialchars($app["Reason"])); ?></p>
    <p><strong>Status:</strong>
        <span class="status-<?php echo strtolower($app["Status"]); ?>">
            <?php echo htmlspecialchars($app["Status"]); ?>
        </span>
    </p>

    <form method="POST" action="">
        <button type="submit" name="status" value="Approved" class="btn btn-approve">Approve</button>
        <button type="submit" name="status" value="Rejected" class="btn btn-reject">Reject</button>
        <button type="submit" name="status" value="Pending" class="btn btn-secondary">Set Pending</button>
        <a href="applications.php" class="btn btn-secondary">Back</a>
    </form>
</section>

<?php include 'footer.php'; ?>
