<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="../Asset/css/dashboard.css">
</head>
<body>
    <div class="overlay">
        <div class="dashboard-container">
            <h1>Welcome to the Library</h1>
            <h2><?php echo htmlspecialchars($_SESSION['name']); ?></h2>

            <div class="dashboard-card"><a href="search_books.php" style="color: inherit; text-decoration: none;">Search Books</a></div>
            <div class="dashboard-card"><a href="view_loans.php" style="color: inherit; text-decoration: none;">My Loans</a></div>
            <div class="dashboard-card"><a href="notification_center.php" style="color: inherit; text-decoration: none;">Notifications</a></div>
            <div class="dashboard-card"><a href="profile.php" style="color: inherit; text-decoration: none;">Profile</a></div>
            <div class="dashboard-card"><a href="../Controller/logout.php" style="color: inherit; text-decoration: none;">Logout</a></div>
        </div>
    </div>
</body>
</html>
