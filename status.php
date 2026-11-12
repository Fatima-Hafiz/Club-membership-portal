<?php
include 'includes/db.php';

$resultData = null;
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $studentID = trim($_POST["studentID"]);
    $clubName = trim($_POST["clubName"]);

    if ($studentID == "" || $clubName == "") {
        $message = "Please enter both Student ID and Club Name.";
    } else {
        $sql = "SELECT FullName, StudentID, ClubName, Status, SubmittedAt FROM applications
                WHERE StudentID = ? AND ClubName = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $studentID, $clubName);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $resultData = mysqli_fetch_assoc($result);
        } else {
            $message = "No application found for the entered details.";
        }
    }
}
?>

<?php include 'includes/header.php'; ?>

<section class="card">
    <h2>Check Application Status</h2>
    <p>Enter your Student ID and Club Name to check your application status.</p>

    <?php if ($message != ""): ?>
        <div class="message-error"><p><?php echo htmlspecialchars($message); ?></p></div>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="form-group">
            <label>Student ID</label>
            <input type="text" name="studentID" required>
        </div>

        <div class="form-group">
            <label>Club Name</label>
            <select name="clubName" required>
                <option value="">-- Select Club --</option>
                <option value="Computing Club">Computing Club</option>
                <option value="Robotics Club">Robotics Club</option>
                <option value="Business Club">Business Club</option>
                <option value="Sports Club">Sports Club</option>
                <option value="Media Club">Media Club</option>
            </select>
        </div>

        <button type="submit" class="btn">Check Status</button>
    </form>
</section>

<?php if ($resultData): ?>
<section class="card">
    <h2>Application Result</h2>
    <p><strong>Name:</strong> <?php echo htmlspecialchars($resultData["FullName"]); ?></p>
    <p><strong>Student ID:</strong> <?php echo htmlspecialchars($resultData["StudentID"]); ?></p>
    <p><strong>Club:</strong> <?php echo htmlspecialchars($resultData["ClubName"]); ?></p>
    <p><strong>Status:</strong>
        <span class="status-<?php echo strtolower($resultData["Status"]); ?>">
            <?php echo htmlspecialchars($resultData["Status"]); ?>
        </span>
    </p>

    <?php if ($resultData["Status"] == "Approved"): ?>
        <a class="btn" href="id_card.php">View ID Card</a>
    <?php endif; ?>
</section>
<?php endif; ?>

<?php include 'includes/footer.php'; ?>
