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
        .action-btn, .edit-btn, .delete-btn {
            padding: 8px 14px;
            border: none;
            border-radius: 6px;
            font-size: 13px;
            font-weight: bold;
            cursor: pointer;
            color: white;
            margin: 2px;
        }
        .action-btn { background-color: #28a745; }
        .edit-btn { background-color: #ffc107; }
        .delete-btn { background-color: #dc3545; }
        .return-link {
            display: inline-block;
            font-weight: bold;
            margin-top: 5px;
            font-size: 14px;
            color: #dc3545;
            text-decoration: none;
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
                <th>Fine (৳)</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($loans as $loan): ?>
                <tr id="loan-<?php echo $loan['id']; ?>">
                    <td><?php echo htmlspecialchars($loan['book_title']); ?></td>
                    <td><?php echo htmlspecialchars($loan['borrow_date']); ?></td>
                    <td><?php echo htmlspecialchars($loan['return_date']); ?></td>
                    <td><?php echo htmlspecialchars($loan['status']); ?></td>
                    <td>
                        <?php
                        $fine = isset($loan['fine_amount']) ? (float)$loan['fine_amount'] : 0;
                        echo $fine > 0 ? number_format($fine, 2) : "-";
                        ?>
                    </td>
                    <td>
                        <?php if ($loan['status'] === 'On Loan'): ?>
                            <button class="action-btn renew-btn" 
                                    data-id="<?php echo $loan['id']; ?>" 
                                    data-title="<?php echo htmlspecialchars($loan['book_title']); ?>">
                                Renew
                            </button>
                            <a href="edit_loan.php?loan_id=<?php echo $loan['id']; ?>" class="edit-btn">Edit</a>
                            <a href="../Controller/delete_loan.php?loan_id=<?php echo $loan['id']; ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this loan?');">Delete</a>
                            <br>
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

<script src="../Asset/js/renew_loan_ajax.js"></script>
</body>
</html>
