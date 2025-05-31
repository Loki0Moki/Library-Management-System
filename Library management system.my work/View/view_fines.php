<?php
session_start();
require_once("../Model/db_connect.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$today = date('Y-m-d');

$fine_data = calculateUserFines($conn, $user_id);
$total_fine = $fine_data['total'];
$fine_details = $fine_data['details'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Fines - Library System</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background: url('../Asset/images/8.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #333;
        }

        .fine-container {
            max-width: 800px;
            margin: 60px auto;
            background: rgba(255, 255, 255, 0.95);
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }

        h2 {
            text-align: center;
            font-size: 28px;
            color: #2e3a59;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 16px;
        }

        th, td {
            padding: 14px 12px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            background-color: #4c91ff;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f3f6fc;
        }

        .pay-btn {
            margin-top: 25px;
            padding: 12px 28px;
            background-color: #28a745;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 10px;
            cursor: pointer;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .pay-btn:hover {
            background-color: #218838;
        }

        .total-text {
            text-align: right;
            font-weight: bold;
            margin-top: 20px;
            font-size: 18px;
        }

        .back-link {
            display: inline-block;
            margin-top: 30px;
            text-align: center;
            background-color: #4c91ff;
            color: white;
            padding: 12px 20px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .back-link:hover {
            background-color: #2e75f0;
        }

        .centered {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="fine-container">
        <h2>Your Total Fine</h2>

        <?php if (empty($fine_details)): ?>
            <p class="centered">You have no outstanding fines.</p>
        <?php else: ?>
            <table>
                <tr>
                    <th>📖 Book Title</th>
                    <th>⏳ Days Overdue</th>
                    <th>৳ Fine</th>
                </tr>
                <?php foreach ($fine_details as $row): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['title']); ?></td>
                        <td><?php echo $row['days']; ?></td>
                        <td><?php echo $row['fine']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>

            <p class="total-text">Total Fine: <?php echo $total_fine; ?> ৳</p>

            <form method="post" action="#">
                <button class="pay-btn" type="submit">💳 Pay Now</button>
            </form>
        <?php endif; ?>

        <div class="centered">
            <a href="dashboard_user.php" class="back-link">← Back to Dashboard</a>
        </div>
    </div>
</body>
</html>
