<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    header("Location: login.php");
    exit();
}
require_once("../Model/db_connect.php");
$user_id = $_SESSION['user_id'];
$total_fine = calculateTotalFineByUserId($conn, $user_id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; }
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: 'Poppins', sans-serif;
            background: #f5f7fa;
        }
        .hero {
            background: url('../Asset/images/6.jpg') no-repeat center center;
            background-size: cover;
            height: 100vh;
            width: 100%;
            position: relative;
            color: #fff;
        }
        .overlay-content {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            padding: 30px 50px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .top-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .top-left, .top-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .dashboard-title {
            text-align: center;
            flex-grow: 1;
            margin: 0;
        }
        .dashboard-title h1 {
            font-size: 36px;
            font-weight: 600;
            text-shadow: 2px 2px 8px rgba(0,0,0,0.6);
            margin: 0;
        }
        .dashboard-card {
            background: rgba(255, 255, 255, 0.92);
            padding: 10px 18px;
            border-radius: 10px;
            text-decoration: none;
            color: #2c3e50;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }
        .dashboard-card:hover {
            background: #ffffff;
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.25);
        }
        .middle-section {
            display: flex;
            justify-content: center;
            gap: 60px;
            align-items: center;
            height: 100%;
        }
        .middle-section .dashboard-card {
            padding: 50px 40px;
            font-size: 24px;
            width: 240px;
            height: 190px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }
        .fine-highlight {
            color: #c0392b;
            font-weight: 700;
        }
        @media screen and (max-width: 768px) {
            .top-header {
                flex-direction: column;
                align-items: center;
                gap: 15px;
            }
            .middle-section {
                flex-direction: column;
                gap: 30px;
            }
            .middle-section .dashboard-card {
                width: 90%;
                font-size: 20px;
                height: auto;
                padding: 30px;
            }
            .dashboard-title h1 {
                font-size: 28px;
            }
        }
    </style>
</head>
<body>
    <div class="hero">
        <div class="overlay-content">

            <!-- Top Header -->
            <div class="top-header">

                <!--  Profile (Left) -->
                <div class="top-left">
                    <a href="profile.php" class="dashboard-card"> Profile</a>
                </div>

                <!--  Title (Center) -->
                <div class="dashboard-title">
                    <h1>Library Management System</h1>
                </div>

                <!-- Contact, Fine, Logout (Right) -->
                <div class="top-right">
                    <a href="view_fines.php" class="dashboard-card">💸 Fine: <span class="fine-highlight"><?php echo number_format($total_fine, 2); ?> ৳</span></a>
                    <a href="contact_us.php" class="dashboard-card">📞 Contact</a>
                    <a href="../Controller/logout.php" class="dashboard-card">🚪 Logout</a>
                </div>
            </div>

            <!--  Middle Navigation Cards -->
            <div class="middle-section">
                <a href="book_catalog.php" class="dashboard-card">📚 Book Catalog</a>
                <a href="view_loans.php" class="dashboard-card">📦 My Loans</a>
                <a href="reading_history.php" class="dashboard-card">📘 Reading History</a>
            </div>

        </div>
    </div>
</body>
</html>