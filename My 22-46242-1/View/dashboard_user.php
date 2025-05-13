<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Dashboard - Library System</title>
    <link rel="stylesheet" href="../Asset/css/style.css">
</head>
<body>
    <header>
        <h1>User Dashboard</h1>
        <nav>
            <a href="search_books.php">Search Books</a> |
            <a href="view_loans.php">My Loans</a> |
            <a href="view_fines.php">My Fines</a> |
            <a href="notification_center.php">Notifications</a> |
            <a href="profile.php">Profile</a> |
            <a href="../Controller/logout.php">Logout</a>
        </nav>
    </header>
    <main>
        <h2>Welcome, <?php echo $_SESSION['name']; ?>!</h2>
        <p>Explore the library and manage your books easily.</p>
    </main>
</body>
</html>
