<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrower Accounts</title>
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            color: #333;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
            color: #333;
        }

        nav {
            text-align: center;
            margin: 20px 0;
        }

        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 12px 20px;
            margin: 0 10px;
            cursor: pointer;
            font-size: 16px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #45a049;
        }

        .screen {
            display: none;
            padding: 20px;
            max-width: 800px;
            margin: 0 auto;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .active {
            display: block;
        }

        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        label {
            font-weight: bold;
            margin-bottom: 8px;
            display: block;
        }

        input[type="text"],
        input[type="date"],
        input[type="tel"],
        input[type="file"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
        }

        input[type="text"]:focus,
        input[type="date"]:focus,
        input[type="tel"]:focus,
        input[type="file"]:focus {
            border-color: #4CAF50;
            outline: none;
        }

        .loan, .hold {
            margin-bottom: 15px;
        }

        .loan button, .hold button {
            background-color: #2196F3;
            padding: 8px 15px;
            margin-top: 5px;
        }

        .loan button:hover, .hold button:hover {
            background-color: #0b7dda;
        }

        ul {
            list-style-type: none;
            padding-left: 0;
        }

        li {
            padding: 8px 0;
            border-bottom: 1px solid #ddd;
        }

        li:last-child {
            border-bottom: none;
        }
    </style>
</head>
<body>

<h1>Borrower Accounts</h1>

<!-- Navigation Menu -->
<nav>
    <button onclick="showScreen('registrationScreen')">Registration</button>
    <button onclick="showScreen('dashboardScreen')">Account Dashboard</button>
    <button onclick="showScreen('readingHistoryScreen')">Reading History</button>
</nav>

<!-- Registration Form (Screen 1) -->
<div id="registrationScreen" class="screen">
    <h2>Library Registration Form</h2>
    <div class="form-container">
        <form method="POST" enctype="multipart/form-data">
            <label for="fullName">Full Name</label>
            <input type="text" id="fullName" name="fullName" required>

            <label for="dob">Date of Birth</label>
            <input type="date" id="dob" name="dob" required>

            <label for="address">Address</label>
            <input type="text" id="address" name="address" required>

            <label for="contact">Contact Number</label>
            <input type="tel" id="contact" name="contact" required>

            <label for="idProof">Upload ID Proof</label>
            <input type="file" id="idProof" name="idProof" required>

            <button type="submit" name="registerUser">Register</button>
        </form>
    </div>
</div>

<!-- Account Dashboard (Screen 2) -->
<div id="dashboardScreen" class="screen">
    <h2>Your Account Dashboard</h2>
    <div class="form-container">
        <h3>Current Loans</h3>
        <div id="currentLoans">
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
            <div class="hold">
                <strong>Book Title:</strong> "1984" <br>
                <form method="POST">
                    <input type="hidden" name="bookTitle" value="1984">
                    <button type="submit" name="renewHold">Renew</button>
                </form>
            </div>
        </div>

        <h3>Reading History</h3>
        <button onclick="location.href='Reading history.html'">View Reading History</button>
    </div>
</div>

<!-- Reading History (Screen 3) -->
<div id="readingHistoryScreen" class="screen">
    <h2>Your Reading History</h2>
    <div class="form-container">
        <ul id="readingHistoryList">
            <li>"The Catcher in the Rye" - Borrowed on: 2023-01-15</li>
            <li>"To Kill a Mockingbird" - Borrowed on: 2023-02-10</li>
        </ul>
    </div>
</div>

<?php
// PHP validation for registration
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Registration form validation
    if (isset($_POST['registerUser'])) {
        $fullName = $_POST['fullName'] ?? '';
        $dob = $_POST['dob'] ?? '';
        $address = $_POST['address'] ?? '';
        $contact = $_POST['contact'] ?? '';
        $idProof = $_FILES['idProof']['name'] ?? '';

        // Basic validation
        if ($fullName && $dob && $address && $contact && $idProof) {
            echo "<script>alert('Registration successful!');</script>";
        } else {
            echo "<script>alert('Please fill all fields and upload ID proof.');</script>";
        }
    }

    // Loan and Hold renewal handling
    if (isset($_POST['renewLoan']) || isset($_POST['renewHold'])) {
        $bookTitle = $_POST['bookTitle'] ?? '';

        // Basic validation for book renewal
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
