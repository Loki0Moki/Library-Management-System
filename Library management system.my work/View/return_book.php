<?php
session_start();
require_once("../Model/db_connect.php");

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("Location: login.php");
    exit();
}

$loan_id = $_GET['loan_id'] ?? null;

if (!$loan_id) {
    $_SESSION['loan_message'] = "Invalid loan request.";
    header("Location: view_loans.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$loans = getReturnedLoans($conn, $user_id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Return Book</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background: url('../Asset/images/5.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #333;
        }

        .form-container {
            max-width: 600px;
            margin: 100px auto;
            background: rgba(255, 255, 255, 0.95);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.2);
        }

        h2 {
            text-align: center;
            color: #2c3e50;
            font-size: 28px;
            margin-bottom: 30px;
        }

        form label {
            font-weight: 600;
            display: block;
            margin-bottom: 8px;
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
        <h2>📕 Return Book</h2>
        <form method="post" action="../Controller/return_process.php">
            <input type="hidden" name="loan_id" value="<?php echo htmlspecialchars($loan_id); ?>">

            <label for="return_date">Return Date:</label>
            <input type="date" name="return_date" id="return_date" required>

            <button type="submit">✅ Confirm Return</button>
        </form>
        <p><a href="view_loans.php">← Back to Loans</a></p>
    </div>

    <script>
        window.onload = function() {
            const today = new Date().toISOString().split('T')[0];
            const returnDate = document.getElementById('return_date');
            returnDate.min = today;
            returnDate.value = today;
        }
    </script>
</body>
</html>
