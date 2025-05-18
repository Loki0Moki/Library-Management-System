<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("Location: login.php");
    exit();
}
$loans = [
    ['title' => 'Book A', 'borrowed_on' => '2025-04-15', 'due_date' => '2025-05-01', 'status' => 'On Loan'],
    ['title' => 'Book B', 'borrowed_on' => '2025-03-10', 'due_date' => '2025-03-24', 'status' => 'Returned']
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Loans - Library System</title>
    <link rel="stylesheet" href="../Asset/css/style.css">
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
                            <a href="return_book.php?title=<?php echo urlencode($loan['title']); ?>">Return</a>
                        <?php else: ?>
                            -
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <p><a href="dashboard_user.php">← Back to Dashboard</a></p>
    </div>
</body>
</html>
