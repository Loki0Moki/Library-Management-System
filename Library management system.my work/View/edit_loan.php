<?php
session_start();
require_once("../Model/db_connect.php");

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("Location: login.php");
    exit();
}

$loan_id = $_GET['loan_id'] ?? null;

if (!$loan_id) {
    echo "Invalid loan ID.";
    exit();
}

// Fetch loan details
$sql = "SELECT * FROM loans WHERE id = '$loan_id' AND user_id = '{$_SESSION['user_id']}' LIMIT 1";
$result = mysqli_query($conn, $sql);

if (!$result || mysqli_num_rows($result) !== 1) {
    echo "Loan not found.";
    exit();
}

$loan = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Loan - Library System</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: url('../Asset/images/7.jpg') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
        }

        .form-container {
            max-width: 600px;
            margin: 100px auto;
            background: rgba(255, 255, 255, 0.95);
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }

        h2 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 25px;
        }

        label {
            font-weight: bold;
            display: block;
            margin: 15px 0 8px;
        }

        input[type="date"] {
            width: 100%;
            padding: 12px;
            font-size: 15px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        button {
            width: 100%;
            padding: 12px;
            margin-top: 20px;
            background-color: #4c91ff;
            color: white;
            border: none;
            font-weight: bold;
            border-radius: 8px;
            cursor: pointer;
        }

        button:hover {
            background-color: #2e75f0;
        }

        a {
            display: inline-block;
            margin-top: 15px;
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
    <h2> Edit Loan</h2>
    <form action="../Controller/edit_loan_process.php" method="post">
        <input type="hidden" name="loan_id" value="<?php echo $loan['id']; ?>">

        <p><strong>Book:</strong> <?php echo htmlspecialchars($loan['book_title']); ?></p>
        <p><strong>Borrowed On:</strong> <?php echo htmlspecialchars($loan['borrow_date']); ?></p>

        <label for="return_date">New Return Date:</label>
        <input type="date" id="return_date" name="return_date" value="<?php echo htmlspecialchars($loan['return_date']); ?>" required>

        <button type="submit">Update Loan</button>
    </form>
    <a href="view_loans.php">← Back to Loans</a>
</div>
</body>
</html>
