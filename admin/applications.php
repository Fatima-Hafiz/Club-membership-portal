<?php
include 'auth.php';
include '../includes/db.php';

$sql = "SELECT ApplicationID, FullName, StudentID, ClubName, Status, SubmittedAt
        FROM applications
        ORDER BY SubmittedAt DESC";
$result = mysqli_query($conn, $sql);
?>

<?php include 'header.php'; ?>

<section class="card">
    <h2>Applications List</h2>
    <p>All submitted club membership applications are displayed below.</p>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Student ID</th>
                    <th>Club</th>
                    <th>Status</th>
                    <th>Submitted</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($result) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?php echo $row["ApplicationID"]; ?></td>
                            <td><?php echo htmlspecialchars($row["FullName"]); ?></td>
                            <td><?php echo htmlspecialchars($row["StudentID"]); ?></td>
                            <td><?php echo htmlspecialchars($row["ClubName"]); ?></td>
                            <td class="status-<?php echo strtolower($row["Status"]); ?>">
                                <?php echo htmlspecialchars($row["Status"]); ?>
                            </td>
                            <td><?php echo date("d M Y", strtotime($row["SubmittedAt"])); ?></td>
                            <td><a class="btn" href="view_application.php?id=<?php echo $row["ApplicationID"]; ?>">View</a></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7">No applications found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>

<?php include 'footer.php'; ?>
