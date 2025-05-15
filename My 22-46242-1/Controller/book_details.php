<?php
session_start();
require_once("../Model/db_connect.php");

$isbn = $_GET['isbn'] ?? '';

if ($isbn) {
    $stmt = $conn->prepare("SELECT title, author, genre, shelf FROM books WHERE isbn = ?");
    $stmt->bind_param("s", $isbn);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($title, $author, $genre, $shelf);
        $stmt->fetch();
        $found = true;
    } else {
        $found = false;
    }

    $stmt->close();
} else {
    $found = false;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book Details - Library System</title>
    <link rel="stylesheet" href="../Asset/css/style.css">
</head>
<body>
    <div class="book-details-container">
        <h2>Book Details</h2>
        <?php if ($found): ?>
            <p><strong>Title:</strong> <?php echo htmlspecialchars($title); ?></p>
            <p><strong>Author:</strong> <?php echo htmlspecialchars($author); ?></p>
            <p><strong>Genre:</strong> <?php echo htmlspecialchars($genre); ?></p>
            <p><strong>Shelf Location:</strong> <?php echo htmlspecialchars($shelf); ?></p>
            <p><strong>ISBN:</strong> <?php echo htmlspecialchars($isbn); ?></p>
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'user'): ?>
                <a href="borrow_book.php?title=<?php echo urlencode($title); ?>">Borrow this Book</a>
            <?php endif; ?>
        <?php else: ?>
            <p style="color: red;">No book found with the ISBN: <strong><?php echo htmlspecialchars($isbn); ?></strong></p>
        <?php endif; ?>
        <p><a href="search_books.php">← Back to Search</a></p>
    </div>
</body>
</html>
