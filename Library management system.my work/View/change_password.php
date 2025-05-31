<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Change Password</title>
    <link rel="stylesheet" href="../Asset/css/change_password.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="form-container">
        <h2> Change Password</h2>

        <?php if (isset($_SESSION['pass_success'])): ?>
            <p class="message success"><?php echo $_SESSION['pass_success']; unset($_SESSION['pass_success']); ?></p>
        <?php elseif (isset($_SESSION['pass_error'])): ?>
            <p class="message error"><?php echo $_SESSION['pass_error']; unset($_SESSION['pass_error']); ?></p>
        <?php endif; ?>

        <form method="post" action="../Controller/change_password_process.php">
            <label for="current_password">Current Password:</label>
            <input type="password" name="current_password" id="current_password" required>

            <label for="new_password">New Password:</label>
            <input type="password" name="new_password" id="new_password" required>

            <label for="confirm_password">Confirm New Password:</label>
            <input type="password" name="confirm_password" id="confirm_password" required>

            <button type="submit">Update Password</button>
        </form>

        <p><a href="profile.php">← Back to Profile</a></p>
    </div>
</body>
</html>
