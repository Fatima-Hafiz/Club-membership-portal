<?php
session_start();
include '../includes/db.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    if ($username == "" || $password == "") {
        $error = "Please enter username and password.";
    } else {
        $sql = "SELECT AdminID, Username, PasswordHash FROM admin_users WHERE Username = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) == 1) {
            $admin = mysqli_fetch_assoc($result);

            if (password_verify($password, $admin["PasswordHash"])) {
                $_SESSION["admin_id"] = $admin["AdminID"];
                $_SESSION["admin_username"] = $admin["Username"];
                header("Location: dashboard.php");
                exit();
            } else {
                $error = "Invalid username or password.";
            }
        } else {
            $error = "Invalid username or password.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<header class="site-header">
    <div>
        <h1>Club Membership Portal</h1>
        <p>Admin Login</p>
    </div>
    <nav>
        <a href="../index.php">Home</a>
    </nav>
</header>
<main class="container">
    <section class="card">
        <h2>Admin Login</h2>
    
        <?php if ($error != ""): ?>
            <div class="message-error"><p><?php echo htmlspecialchars($error); ?></p></div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>

            <button type="submit" class="btn">Login</button>
        </form>
    </section>
</main>
<footer class="site-footer">
    <p>&copy; 2026 AJMD College Club Membership Portal</p>
</footer>
</body>
</html>
