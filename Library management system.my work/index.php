<?php
session_start();

// Auto-redirect to dashboard if already logged in
if (isset($_SESSION['user_id']) && $_SESSION['role'] === 'user') {
    header("Location: View/dashboard_user.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Library Landing Page</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            display: flex;
            height: 100vh;
            background-color: #f9f9f9;
            color: #333;
        }

        .left-image {
            width: 45%;
            margin-left: 40px;
            background-color: #f9f9f9;
            background-image: url('Asset/images/5.jpg');
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
        }

        .right-content {
            flex: 1;
            background-color: #f9f9f9;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 40px;
        }

        .right-content h2 {
            font-size: 42px;
            margin-bottom: 20px;
            color: #2e3a59;
        }

        .right-content p {
            font-size: 18px;
            max-width: 600px;
            color: #555;
        }

        .buttons {
            margin-top: 30px;
        }

        .buttons a {
            text-decoration: none;
            background-color: #4c91ff;
            color: white;
            padding: 12px 25px;
            border-radius: 6px;
            margin: 0 10px;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .buttons a:hover {
            background-color: #2e75f0;
        }

        footer {
            margin-top: 40px;
            font-size: 14px;
            color: #777;
        }

        @media (max-width: 768px) {
            body {
                flex-direction: column;
            }
            .left-image {
                width: 100%;
                height: 200px;
                margin-left: 0;
                background-size: cover;
            }
        }
    </style>
</head>
<body>

<!-- ✅ LEFT SIDE IMAGE -->
<div class="left-image"></div>

<!-- ✅ RIGHT SIDE CONTENT -->
<div class="right-content">
    <h2>📚 Welcome to Your Digital Library</h2>
    <p>Explore, borrow, and manage your books easily with our modern library system. Start your reading journey today!</p>
    
    <div class="buttons">
        <a href="View/login.php">Login</a>
        <a href="View/register.php">Register</a>
    </div>
    
    <footer>
        <?php echo '&copy; ' . date('Y') . ' Library Management System. All rights reserved.'; ?>
    </footer>
</div>

</body>
</html>
