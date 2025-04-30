<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Dashboard</title>
    <style>
        /* Basic Body Styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f9;
        }

        /* Dashboard Container */
        .dashboard {
            max-width: 800px;
            margin: 0 auto;
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Header Styling */
        h2 {
            text-align: center;
            color: #333;
        }

        /* Section Title Styling */
        h3 {
            margin-top: 20px;
            color: #444;
        }

        /* Loan and Hold Box Styling */
        .loan, .hold {
            background-color: #f9f9f9;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .loan button, .hold button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .loan button:hover, .hold button:hover {
            background-color: #45a049;
        }

        /* View Reading History Button */
        button.view-history {
            background-color: #2196F3;
            color: white;
            border: none;
            padding: 12px 20px;
            margin-top: 20px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        button.view-history:hover {
            background-color: #0b7dda;
        }
    </style>
</head>
<body>

<div class="dashboard">
    <h2>Your Account Dashboard</h2>

    <h3>Current Loans</h3>
    <div id="currentLoans">
        <!-- Dynamically filled with loan data -->
        <div class="loan">
            <strong>Book Title:</strong> "The Great Gatsby" <br>
            <form method="POST">
                <input type="hidden" name="bookTitle" value="The Great Gatsby">
                <button type="submit" name="renewLoan">Renew</button>
            </form>
        </div>
    </div>

    <h3>Current Holds</h3>
    <div id="currentHolds">
        <!-- Dynamically filled with hold data -->
        <div class="hold">
            <strong>Book Title:</strong> "1984" <br>
            <form method="POST">
                <input type="hidden" name="bookTitle" value="1984">
                <button type="submit" name="renewHold">Renew</button>
            </form>
        </div>
    </div>

    <h3>Reading History</h3>
    <button class="view-history" onclick="location.href='Reading history.html'">View Reading History</button>
</div>

<?php
// Basic PHP validation logic for renew buttons
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if the renew button for a loan or hold was clicked
    if (isset($_POST['renewLoan']) || isset($_POST['renewHold'])) {
        $bookTitle = $_POST['bookTitle'] ?? '';

        // Simple validation: Check if book title is provided
        if (!empty($bookTitle)) {
            echo "<script>alert('Renewal request for: $bookTitle');</script>";
        } else {
            echo "<script>alert('Error: No book title provided.');</script>";
        }
    }
}
?>

</body>
</html>
