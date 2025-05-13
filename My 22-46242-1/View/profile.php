<?php
session_start();
if (!isset($_SESSION['role'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Profile - Library System</title>
    <link rel="stylesheet" href="../Asset/css/style.css">
</head>
<body>
    <h2>My Profile</h2>
    <p><strong>Name:</strong> <?php echo $_SESSION['name']; ?></p>
    <p><strong>Email:</strong> <?php echo $_SESSION['email']; ?></p>
    <p><a href="edit_profile.php">Edit Profile</a> | <a href="change_password.php">Change Password</a></p>
    <p><a href="dashboard_user.php">← Back to Dashboard</a></p>
</body>
</html>
