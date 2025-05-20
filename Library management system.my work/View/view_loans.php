<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("Location: login.php");
    exit();
}

// Sample data for demonstration
$loans = [
    ['id' => 1, 'title' => 'Book A', 'borrowed_on' => '2025-04-15', 'due_date' => '2025-05-01', 'status' => 'On Loan'],
    ['id' => 2, 'title' => 'Book B', 'borrowed_on' => '2025-03-10', 'due_date' => '2025-03-24', 'status' => 'Returned']
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Loans - Library System</title>
    <link rel="stylesheet" href="../Asset/css/style.css">
    <style>
        .table-container {
            max-width: 900px;
            margin: 40px auto;
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 16px;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ddd;
        }

        th {
            background-color: #4c91ff;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .btn-link {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            padding: 10px 15px;
            background-color: #4c91ff;
            color: white;
            border-radius: 8px;
        }

        .btn-link:hover {
            background-color: #3a75d3;
        }
    </style>
</head>
<body>
    <div class="table-container">
        <h2>My Borrowed Books</h2>
        <table>
            <tr>
                <th>Title</th>
                <th>Borrowed On</th>
                <th>Due Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            <?php foreach ($loans as $loan): ?>
                <tr>
                    <td><?php echo htmlspecialchars($loan['title']); ?></td>
                    <td><?php echo $loan['borrowed_on']; ?></td>
                    <td><?php echo $loan['due_date']; ?></td>
                    <td><?php echo $loan['status']; ?></td>
                    <td>
                        <?php if ($loan['status'] === 'On Loan'): ?>
                            <form action="../Controller/renew_loan.php" method="post" style="display:inline;">
                                <input type="hidden" name="loan_id" value="<?php echo $loan['id']; ?>">
                                <button type="submit">Renew</button>
                            </form>
                            <a href="return_book.php?title=<?php echo urlencode($loan['title']); ?>">Return</a>
                        <?php else: ?>
                            -
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

        <a href="reading_history.php" class="btn-link">📖 Track Reading History</a>
        <br><br>
        <a href="dashboard_user.php" class="btn-link">← Back to Dashboard</a>
    </div>
</body>
</html>
