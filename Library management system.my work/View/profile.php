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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background: url('../Asset/images/11.jpg') no-repeat center center fixed;
            background-size: cover; /*makes the image large and fills full screen */
            color: #333;
            min-height: 100vh;
        }

        .profile-container {
            max-width: 600px;
            margin: 100px auto;
            background: rgba(255, 255, 255, 0.95);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        h2 {
            font-size: 28px;
            color: #2c3e50;
            margin-bottom: 30px;
        }

        .profile-info p {
            font-size: 18px;
            margin: 12px 0;
            color: #444;
        }

        .profile-info strong {
            color: #222;
        }

        .profile-actions {
            margin-top: 30px;
        }

        .profile-actions a {
            display: inline-block;
            margin: 8px 10px;
            padding: 12px 20px;
            background-color: #4c91ff;
            color: white;
            text-decoration: none;
            font-weight: bold;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }

        .profile-actions a:hover {
            background-color: #2e75f0;
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <h2>My Profile</h2>

        <div class="profile-info">
            <p><strong>Name:</strong> <?php echo htmlspecialchars($_SESSION['name']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($_SESSION['email']); ?></p>
        </div>

        <div class="profile-actions">
            <a href="edit_profile.php">Edit Profile</a>
            <a href="change_password.php">Change Password</a>
            <a href="dashboard_user.php">← Back to Dashboard</a>
        </div>
    </div>
</body>
</html>