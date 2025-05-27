<?php
session_start();
require_once("../Model/db_connect.php");

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$loans = getUserLoans($conn, $user_id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Loans - Library System</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: url('../Asset/images/9.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #333;
        }
        .table-container {
            max-width: 1000px;
            margin: 60px auto;
            background: rgba(255, 255, 255, 0.95);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }
        h2 {
            text-align: center;
            font-size: 28px;
            margin-bottom: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 16px;
        }
        th, td {
            padding: 14px;
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
        .action-btn {
            padding: 8px 16px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
        }
        .return-link {
            color: #dc3545;
            font-weight: bold;
            margin-left: 8px;
            text-decoration: none;
            font-size: 14px;
        }
        .btn-link {
            display: inline-block;
            margin-top: 30px;
            margin-right: 10px;
            background-color: #4c91ff;
            color: white;
            padding: 12px 20px;
            border-radius: 8px;
            font-weight: bold;
            text-decoration: none;
        }
        .btn-link:hover { background-color: #2e75f0; }

        @media screen and (max-width: 768px) {
            table { font-size: 14px; }
            .action-btn { padding: 6px 12px; }
        }
    </style>
</head>
<body>
<div class="table-container">
    <h2>📦 My Borrowed Books</h2>

    <?php if (count($loans) > 0): ?>
        <table>
            <tr>
                <th>Title</th>
                <th>Borrowed On</th>
                <th>Due Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            <?php foreach ($loans as $loan): ?>
                <tr id="loan-<?php echo $loan['id']; ?>">
                    <td><?php echo htmlspecialchars($loan['book_title']); ?></td>
                    <td><?php echo htmlspecialchars($loan['borrow_date']); ?></td>
                    <td class="due-date"><?php echo htmlspecialchars($loan['return_date']); ?></td>
                    <td class="status"><?php echo htmlspecialchars($loan['status']); ?></td>
                    <td>
                        <?php if ($loan['status'] === 'On Loan'): ?>
                            <button class="action-btn renew-btn" 
                                    data-id="<?php echo $loan['id']; ?>" 
                                    data-title="<?php echo htmlspecialchars($loan['book_title']); ?>">
                                Renew
                            </button>
                            <a class="return-link" href="return_book.php?loan_id=<?php echo $loan['id']; ?>">Return</a>
                        <?php else: ?>
                            -
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p style="text-align:center;">No borrowed books yet.</p>
    <?php endif; ?>

    <div style="text-align: center;">
        <a href="reading_history.php" class="btn-link">📖 Track Reading History</a>
        <a href="dashboard_user.php" class="btn-link">← Back to Dashboard</a>
    </div>
</div>

<!-- AJAX -->
<script src="../Asset/js/renew_loan_ajax.js"></script>
</body>
</html>