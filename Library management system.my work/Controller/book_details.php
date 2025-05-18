<?php
session_start();
require_once("../Model/db_connect.php");

$isbn = $_GET['isbn'] ?? '';
$book = false;

if (!empty($isbn)) {
    $book = getBookDetailsByISBN($conn, $isbn);
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

        <?php if ($book): ?>
            <p><strong>Title:</strong> <?php echo htmlspecialchars($book['title']); ?></p>
            <p><strong>Author:</strong> <?php echo htmlspecialchars($book['author']); ?></p>
            <p><strong>Genre:</strong> <?php echo htmlspecialchars($book['genre']); ?></p>
            <p><strong>Shelf Location:</strong> <?php echo htmlspecialchars($book['shelf']); ?></p>
            <p><strong>ISBN:</strong> <?php echo htmlspecialchars($isbn); ?></p>

            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'user'): ?>
                <a href="../View/borrow_book.php?title=<?php echo urlencode($book['title']); ?>">Borrow this Book</a>
            <?php endif; ?>

        <?php else: ?>
            <p style="color: red;">No book found with the ISBN: <strong><?php echo htmlspecialchars($isbn); ?></strong></p>
        <?php endif; ?>

        <p><a href="search_books.php">← Back to Search</a></p>
    </div>
</body>
</html>
