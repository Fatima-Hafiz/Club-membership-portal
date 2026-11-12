<?php
include 'includes/db.php';

$errors = [];
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = trim($_POST["fullName"]);
    $studentID = trim($_POST["studentID"]);
    $email = trim($_POST["email"]);
    $phone = trim($_POST["phone"]);
    $programme = trim($_POST["programme"]);
    $level = trim($_POST["level"]);
    $clubName = trim($_POST["clubName"]);
    $reason = trim($_POST["reason"]);
    $agreement = isset($_POST["agreement"]);

    // Simple validation for Level 4 students
    if ($fullName == "") {
        $errors[] = "Full Name is required.";
    }
    if ($studentID == "") {
        $errors[] = "Student ID is required.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "A valid email address is required.";
    }
    if ($phone == "") {
        $errors[] = "Phone number is required.";
    }
    if ($programme == "") {
        $errors[] = "Programme is required.";
    }
    if ($level == "") {
        $errors[] = "Level is required.";
    }
    if ($clubName == "") {
        $errors[] = "Club Name is required.";
    }
    if ($reason == "") {
        $errors[] = "Reason for joining is required.";
    }
    if (!$agreement) {
        $errors[] = "You must agree that the information is correct.";
    }

    if (empty($errors)) {
        $sql = "INSERT INTO applications (FullName, StudentID, Email, Phone, Programme, Level, ClubName, Reason)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssssssss", $fullName, $studentID, $email, $phone, $programme, $level, $clubName, $reason);

        if (mysqli_stmt_execute($stmt)) {
            $applicationID = mysqli_insert_id($conn);
            $success = "Application submitted successfully. Your reference number is APP-" . $applicationID . ".";
        } else {
            if (mysqli_errno($conn) == 1062) {
                $errors[] = "You have already applied for this club using the same Student ID.";
            } else {
                $errors[] = "Error saving application: " . mysqli_error($conn);
            }
        }
    }
}
?>

<?php include 'includes/header.php'; ?>

<section class="card">
    <h2>Membership Application Form</h2>
    <p>Please complete the form below to apply for club membership.</p>

    <?php if (!empty($errors)): ?>
        <div class="message-error">
            <?php foreach ($errors as $error): ?>
                <p><?php echo htmlspecialchars($error); ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php if ($success != ""): ?>
        <div class="message-success">
            <p><?php echo $success; ?></p>
        </div>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="form-group">
            <label>Full Name</label>
            <input type="text" name="fullName" placeholder="Enter your full name"  required>
        </div>

        <div class="form-group">
            <label>Student ID</label>
            <input type="text" name="studentID" placeholder="Enter your student ID" required>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" placeholder="id@gulfcollege.edu.om" required>
        </div>

        <div class="form-group">
            <label>Phone</label>
            <input type="text" name="phone" placeholder="Enter your phone number" required>
        </div>

        <div class="form-group">
            <label>Programme</label>
            <select name="programme" require>
                <option value="">-- Select programme --</option>
                <option value="information technology">Information Technology</option>
                <option value="computer science">Computer Science</option>
                <option value="busniess">Busniess Computing</option>
                <option value="networking">Networking</option>
                <option value="software">Software</option>
            </select>
        </div>

        <div class="form-group">
            <label>Level</label>
            <select name="level" required>
                <option value="">-- Select Level --</option>
                <option value="Level 3">Level 3</option>
                <option value="Level 4">Level 4</option>
                <option value="Level 5">Level 5</option>
                <option value="Level 6">Level 6</option>
            </select>
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

        <div class="form-group">
            <label>Reason for Joining</label>
            <textarea name="reason" required></textarea>
        </div>

        <div class="form-group checkbox-row">
            <input type="checkbox" name="agreement" id="agreement">
            <label for="agreement">I confirm that the information provided is correct.</label>
        </div>

        <button type="submit" class="btn">Submit Application</button>
    </form>
</section>

<?php include 'includes/footer.php'; ?>
