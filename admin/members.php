<?php
include 'auth.php';
include '../includes/db.php';

$sql = "SELECT ApplicationID, FullName, StudentID, Programme, Level, ClubName, SubmittedAt
        FROM applications
        WHERE Status = 'Approved'
        ORDER BY ClubName, FullName";
$result = mysqli_query($conn, $sql);
?>

<?php include 'header.php'; ?>

<section class="card">
    <h2>Approved Members</h2>
    <p>This page shows students whose applications have been approved.</p>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Student ID</th>
                    <th>Programme</th>
                    <th>Level</th>
                    <th>Club</th>
                    <th>Member Since</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($result) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row["FullName"]); ?></td>
                            <td><?php echo htmlspecialchars($row["StudentID"]); ?></td>
                            <td><?php echo htmlspecialchars($row["Programme"]); ?></td>
                            <td><?php echo htmlspecialchars($row["Level"]); ?></td>
                            <td><?php echo htmlspecialchars($row["ClubName"]); ?></td>
                            <td><?php echo date("d M Y", strtotime($row["SubmittedAt"])); ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">No approved members yet.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>

<?php include 'footer.php'; ?>
