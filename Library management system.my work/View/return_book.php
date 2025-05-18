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
    <title>Return Book - Library System</title>
    <link rel="stylesheet" href="../Asset/css/style.css">
</head>
<body>
    <div class="form-container">
        <h2>Return Book</h2>
        <form action="../Controller/return_process.php" method="post">
            <input type="hidden" name="title" value="<?php echo htmlspecialchars($title); ?>">
            <p>Returning: <strong><?php echo htmlspecialchars($title); ?></strong></p>
            <label for="return_date">Return Date:</label>
            <input type="date" name="return_date" id="return_date" required>
            <button type="submit">Return Book</button>
        </form>
        <p><a href="view_loans.php">← Back to My Loans</a></p>
    </div>
</body>
</html>
