<?php
require_once("../Model/db_connect.php");

$keyword = $_GET['keyword'] ?? '';
$category = $_GET['category'] ?? '';

$result = searchBooks($conn, $keyword, $category);

if (mysqli_num_rows($result) > 0) {
    while ($book = mysqli_fetch_assoc($result)) {
        echo "<div class='book-item'>";
        echo "<strong>" . htmlspecialchars($book['title']) . "</strong><br>";
        echo "Author: " . htmlspecialchars($book['author']) . "<br>";
        echo "Genre: " . htmlspecialchars($book['genre']) . "<br>";
        echo "Shelf: " . htmlspecialchars($book['shelf']) . "<br>";

        echo "<form method='post' action='borrow_book.php'>";
        echo "<input type='hidden' name='book_id' value='" . $book['id'] . "'>";
        echo "<button type='submit'>Borrow</button>";
        echo "</form>";

        echo "</div>";
    }
} else {
    echo "<p>No books found.</p>";
}
?>
