<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Library Management System</title>
    <link rel="stylesheet" href="../Asset/css/style.css">
</head>
<body>
    <header>
        <h1>Welcome to the Library Management System</h1>
        <nav>
            <a href="login.php">Login</a> |
            <a href="register.php">Register</a> |
            <a href="search_books.php">Search Books</a>
        </nav>
    </header>
    <main>
        <section>
            <h2>Discover Books, Manage Your Library Activity</h2>
            <p>Use this system to explore available books, manage your account, borrow and return books easily.</p>
        </section>
    </main>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> Library Management System. All rights reserved.</p>
    </footer>
</body>
</html>
