<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("Location: login.php");
    exit();
}
$fines = [
    ['title' => 'Book A', 'due_date' => '2025-04-25', 'returned' => '2025-05-01', 'fine' => 1.50],
    ['title' => 'Book C', 'due_date' => '2025-04-10', 'returned' => '2025-04-20', 'fine' => 2.50]
];
$total_fine = array_sum(array_column($fines, 'fine'));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Fines - Library System</title>
    <link rel="stylesheet" href="../Asset/css/style.css">
</head>
<body>
    <div class="table-container">
        <h2>Overdue Fines</h2>
        <table>
            <tr>
                <th>Book Title</th>
                <th>Due Date</th>
                <th>Returned On</th>
                <th>Fine ($)</th>
            </tr>
            <?php foreach ($fines as $fine): ?>
                <tr>
                    <td><?php echo htmlspecialchars($fine['title']); ?></td>
                    <td><?php echo $fine['due_date']; ?></td>
                    <td><?php echo $fine['returned']; ?></td>
                    <td><?php echo number_format($fine['fine'], 2); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
        <p><strong>Total Fine: $<?php echo number_format($total_fine, 2); ?></strong></p>
        <p><a href="dashboard_user.php">← Back to Dashboard</a></p>
    </div>
</body>
</html>
