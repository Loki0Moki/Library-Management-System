<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("Location: login.php");
    exit();
}
$title = $_GET['title'] ?? 'Unknown Book';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Borrow Book - Library System</title>
    <link rel="stylesheet" href="../Asset/css/style.css">
</head>
<body>
    <div class="form-container">
        <h2>Borrow Book</h2>
        <form action="../Controller/borrow_process.php" method="post">
            <input type="hidden" name="title" value="<?php echo htmlspecialchars($title); ?>">
            <p>You are borrowing: <strong><?php echo htmlspecialchars($title); ?></strong></p>
            <label for="borrow_date">Borrow Date:</label>
            <input type="date" name="borrow_date" id="borrow_date" required>
            <label for="return_date">Expected Return Date:</label>
            <input type="date" name="return_date" id="return_date" required>
            <button type="submit">Confirm Borrow</button>
        </form>
        <p><a href="dashboard_user.php">← Back to Dashboard</a></p>
    </div>
</body>
</html>
