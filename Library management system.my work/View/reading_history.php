<?php
session_start();
require_once("../Model/db_connect.php");

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$loans = [];
$sql = "SELECT id, book_title, borrow_date, return_date, actual_return, status 
        FROM loans 
        WHERE user_id = '$user_id' AND status = 'Returned' 
        ORDER BY actual_return DESC";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $loans[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Returned Books - Library System</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: url('../Asset/images/10.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #333;
        }

        .table-container {
            max-width: 1000px;
            margin: 60px auto;
            background: rgba(255, 255, 255, 0.96);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        h2 {
            text-align: center;
            color: #2e3a59;
            font-size: 28px;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 16px;
        }

        th, td {
            padding: 14px 12px;
            border: 1px solid #ccc;
            text-align: center;
        }

        th {
            background-color: #4c91ff;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f6ff;
        }

        .btn-link {
            display: inline-block;
            margin-top: 30px;
            text-decoration: none;
            background-color: #4c91ff;
            color: white;
            padding: 12px 20px;
            border-radius: 8px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .btn-link:hover {
            background-color: #2e75f0;
        }

        p {
            text-align: center;
        }

        @media screen and (max-width: 768px) {
            .table-container {
                padding: 20px;
            }

            table {
                font-size: 14px;
            }

            th, td {
                padding: 10px;
            }

            .btn-link {
                padding: 10px 16px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="table-container">
        <h2>📘 Reading History (Returned Books)</h2>

        <?php if (count($loans) > 0): ?>
            <table>
                <tr>
                    <th>Title</th>
                    <th>Borrowed On</th>
                    <th>Due Date</th>
                    <th>Returned On</th>
                    <th>Status</th>
                </tr>
                <?php foreach ($loans as $loan): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($loan['book_title']); ?></td>
                        <td><?php echo htmlspecialchars($loan['borrow_date']); ?></td>
                        <td><?php echo htmlspecialchars($loan['return_date']); ?></td>
                        <td><?php echo htmlspecialchars($loan['actual_return']); ?></td>
                        <td><?php echo htmlspecialchars($loan['status']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p>No returned books yet.</p>
        <?php endif; ?>

        <div style="text-align: center;">
            <a href="dashboard_user.php" class="btn-link">← Back to Dashboard</a>
        </div>
    </div>
</body>
</html>
