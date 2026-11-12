<?php
include 'includes/db.php';

$member = null;
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $studentID = trim($_POST["studentID"]);
    $clubName = trim($_POST["clubName"]);

    if ($studentID == "" || $clubName == "") {
        $message = "Please enter both Student ID and Club Name.";
    } else {
        $sql = "SELECT FullName, StudentID, Programme, Level, ClubName, SubmittedAt FROM applications
                WHERE StudentID = ? AND ClubName = ? AND Status = 'Approved'";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $studentID, $clubName);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $member = mysqli_fetch_assoc($result);
        } else {
            $message = "ID card is available only for approved members.";
        }
    }
}
?>

<?php include 'includes/header.php'; ?>

<section class="card">
    <h2>Member ID Card</h2>
    <p>Approved members may view and print their club ID card.</p>

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

        <button type="submit" class="btn">View ID Card</button>
    </form>

    <?php if ($member): ?>
        <div class="id-card">
            <h3>AJMD College Club ID</h3>
            <p><strong>Name:</strong> <?php echo htmlspecialchars($member["FullName"]); ?></p>
            <p><strong>Student ID:</strong> <?php echo htmlspecialchars($member["StudentID"]); ?></p>
            <p><strong>Programme:</strong> <?php echo htmlspecialchars($member["Programme"]); ?></p>
            <p><strong>Level:</strong> <?php echo htmlspecialchars($member["Level"]); ?></p>
            <p><strong>Club:</strong> <?php echo htmlspecialchars($member["ClubName"]); ?></p>
            <p><strong>Member Since:</strong> <?php echo date("d M Y", strtotime($member["SubmittedAt"])); ?></p>
        </div>
        <br>
        <button onclick="window.print()" class="btn">Print ID Card</button>
    <?php endif; ?>
</section>

<?php include 'includes/footer.php'; ?>
