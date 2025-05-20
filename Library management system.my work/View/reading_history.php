<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("Location: login.php");
    exit();
}

require_once("../Model/db_connect.php");

$user_id = $_SESSION['user_id'];

$query = "SELECT b.title, l.borrow_date, l.return_date, l.actual_return, l.status
          FROM loans l
          JOIN books b ON l.book_title = b.title
          WHERE l.user_id = ?
          ORDER BY l.borrow_date DESC";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reading History - Library System</title>
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
    </style>
</head>
<body>
    <div class="table-container">
        <h2>Your Reading History</h2>
        <table>
            <tr>
                <th>Title</th>
                <th>Borrowed On</th>
                <th>Due Date</th>
                <th>Returned On</th>
                <th>Status</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['title']); ?></td>
                    <td><?php echo $row['borrow_date']; ?></td>
                    <td><?php echo $row['return_date']; ?></td>
                    <td><?php echo $row['actual_return'] ?: '-'; ?></td>
                    <td><?php echo $row['status']; ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
        <p><a href="dashboard_user.php">← Back to Dashboard</a></p>
    </div>
</body>
</html>
