<?php
session_start();
require_once("../Model/db_connect.php");

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("Location: login.php");
    exit();
}

$book_id = $_POST['book_id'] ?? null;

if (!$book_id) {
    $_SESSION['loan_message'] = "No book selected.";
    header("Location: book_catalog.php");
    exit();
}

// Get book details from database
$sql = "SELECT title FROM books WHERE id = '$book_id'";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);
    $title = $row['title'];
} else {
    $title = "Unknown Book";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Borrow Book - Library System</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background: url('../Asset/images/7.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #333;
        }

        .form-container {
            max-width: 600px;
            margin: 80px auto;
            background-color: rgba(255, 255, 255, 0.95);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.25);
        }

        h2 {
            text-align: center;
            color: #2c3e50;
            font-size: 28px;
            margin-bottom: 30px;
        }

        p {
            font-size: 16px;
            margin-bottom: 20px;
        }

        form label {
            font-weight: 600;
            margin-bottom: 8px;
            display: block;
            color: #2e3a59;
        }

        form input[type="date"] {
            width: 100%;
            padding: 12px;
            font-size: 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        form button {
            width: 100%;
            padding: 14px;
            font-size: 16px;
            font-weight: bold;
            background-color: #4c91ff;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        form button:hover {
            background-color: #2e75f0;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            color: #4c91ff;
            text-decoration: none;
            font-weight: 600;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>📚 Borrow Book</h2>
        <form action="../Controller/borrow_process.php" method="post">
            <input type="hidden" name="book_id" value="<?php echo htmlspecialchars($book_id); ?>">
            <input type="hidden" name="title" value="<?php echo htmlspecialchars($title); ?>">

            <p>You are borrowing: <strong><?php echo htmlspecialchars($title); ?></strong></p>

            <label for="borrow_date">Borrow Date:</label>
            <input type="date" name="borrow_date" id="borrow_date" required>

            <label for="return_date">Expected Return Date:</label>
            <input type="date" name="return_date" id="return_date" required>

            <button type="submit">✅ Confirm Borrow</button>
        </form>
        <p><a href="dashboard_user.php">← Back to Dashboard</a></p>
    </div>
    <script>
        window.onload = function() {
            const today = new Date().toISOString().split('T')[0];
            const borrowDate = document.getElementById('borrow_date');
            const returnDate = document.getElementById('return_date');

            borrowDate.min = today;
            borrowDate.value = today;

            returnDate.min = today;

            borrowDate.addEventListener('change', function() {
                returnDate.min = this.value;
                if (returnDate.value < this.value) {
                    returnDate.value = this.value;
                }
            });
        }
    </script>
</body>
</html>
