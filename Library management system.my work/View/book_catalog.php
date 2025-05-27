<?php
session_start();
require_once("../Model/db_connect.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book Catalog</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background: url('../Asset/images/4.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #333;
        }

        .catalog-container {
            max-width: 900px;
            margin: 60px auto;
            background: rgba(255, 255, 255, 0.95);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 32px;
            color: #2e3a59;
        }

        form {
            display: flex;
            gap: 12px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }

        input[type="text"], select {
            padding: 12px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 8px;
            flex: 1;
            min-width: 200px;
        }

        .book-item {
            margin-bottom: 25px;
            padding: 18px;
            background-color: #f0f4ff;
            border-left: 5px solid #4c91ff;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .book-item strong {
            font-size: 20px;
            color: #2c3e50;
        }

        .book-item form {
            margin-top: 12px;
        }

        .book-item button {
            padding: 8px 14px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 15px;
            cursor: pointer;
        }

        .book-item button:hover {
            background-color: #218838;
        }

        a.back-link {
            display: inline-block;
            margin-top: 30px;
            color: #4c91ff;
            text-decoration: none;
            font-weight: bold;
        }

        a.back-link:hover {
            text-decoration: underline;
        }

        #book-results p {
            font-style: italic;
            color: #777;
        }

        @media screen and (max-width: 768px) {
            form {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="catalog-container">
        <h2>📚 Book Catalog</h2>

        <!-- Search Form -->
        <form id="catalog-form">
            <input type="text" name="keyword" id="keyword" placeholder="Search by title or author">
            <select name="category" id="category">
                <option value="">All Categories</option>
                <option value="Fiction">Fiction</option>
                <option value="Science">Science</option>
                <option value="History">History</option>
                <option value="Biography">Biography</option>
            </select>
        </form>

        <!-- Results Will Load Here -->
        <div id="book-results"></div>

        <a href="dashboard_user.php" class="back-link">← Back to Dashboard</a>
    </div>

    <!-- Load AJAX Script -->
    <script src="../Asset/js/search_book_ajax.js"></script>
</body>
</html>