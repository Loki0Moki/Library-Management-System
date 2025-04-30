<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reading History</title>
    <style>
        /* Body Styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f9;
        }

        /* Container for Reading History */
        .history {
            max-width: 600px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Heading Styling */
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        /* Unordered List Styling */
        ul {
            list-style-type: none;
            padding-left: 0;
        }

        /* List Item Styling */
        li {
            background-color: #f9f9f9;
            padding: 12px;
            margin: 10px 0;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            font-size: 16px;
            color: #555;
        }

        /* Button Styling */
        button {
            background-color: #2196F3;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s ease;
            margin-top: 20px;
        }

        button:hover {
            background-color: #0b7dda;
        }
    </style>
</head>
<body>

<div class="history">
    <h2>Your Reading History</h2>
    <ul id="readingHistoryList">
        <!-- Dynamically filled with reading history -->
        <?php
        // Sample reading history data (this can come from a database or backend)
        $readingHistory = [
            ["title" => "The Catcher in the Rye", "borrowedOn" => "2023-01-15"],
            ["title" => "To Kill a Mockingbird", "borrowedOn" => "2023-02-10"],
            ["title" => "1984", "borrowedOn" => "2023-03-05"],  // Added a new book for demonstration
            ["title" => "Pride and Prejudice", "borrowedOn" => "2023-04-01"]  // Added a new book for demonstration
        ];

        // Loop through the reading history and display each item
        foreach ($readingHistory as $book) {
            echo "<li>\"{$book['title']}\" - Borrowed on: {$book['borrowedOn']}</li>";
        }
        ?>
    </ul>

    <button onclick="location.href='Account.html'">Back to Dashboard</button>
</div>
</body>
</html>
