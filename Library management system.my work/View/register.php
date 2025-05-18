<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - Library System</title>
    <link rel="stylesheet" href="../Asset/css/style.css">
</head>
<body>
    <div class="form-container">
        <h2>Create an Account</h2>
        <?php if (isset($_SESSION['register_error'])): ?>
            <p class="error"><?php echo $_SESSION['register_error']; unset($_SESSION['register_error']); ?></p>
        <?php endif; ?>
        <form action="../Controller/register_validation.php" method="post">
            <label for="name">Full Name:</label>
            <input type="text" name="name" id="name" required>
            <label for="email">Email Address:</label>
            <input type="email" name="email" id="email" required>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" name="confirm_password" id="confirm_password" required>
            <button type="submit">Register</button>
        </form>
        <p>Already have an account? <a href="login.php">Login Here</a></p>
    </div>
</body>
</html>
