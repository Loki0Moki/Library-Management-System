<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Support - Library System</title>
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

        .container {
            max-width: 700px;
            margin: 60px auto;
            background-color: rgba(255, 255, 255, 0.97);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        h2 {
            text-align: center;
            color: #2c3e50;
            font-size: 28px;
            margin-bottom: 10px;
        }

        p {
            text-align: center;
            margin-bottom: 30px;
            font-size: 16px;
        }

        form label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #444;
        }

        form input, form textarea {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 16px;
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

        .support-info {
            margin-top: 30px;
            background: #f2f2f2;
            padding: 20px;
            border-radius: 12px;
        }

        .support-info h4 {
            margin-bottom: 5px;
            color: #2e3a59;
        }

        .support-info p {
            margin: 0 0 15px;
        }

        .success-message {
            background-color: #d4edda;
            color: #155724;
            padding: 12px;
            border-left: 5px solid #28a745;
            margin-bottom: 20px;
            border-radius: 8px;
            font-weight: 500;
        }

        .back-link {
            display: inline-block;
            margin-top: 30px;
            text-align: center;
            background-color: #4c91ff;
            color: white;
            padding: 12px 20px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .back-link:hover {
            background-color: #2e75f0;
        }

        .back-container {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Contact Library Help & Support</h2>
        <p>If you're facing any issue, feel free to reach out!</p>

        <?php
        if (isset($_SESSION["contact_success"])) {
            echo "<div class='success-message'>".$_SESSION["contact_success"]."</div>";
            unset($_SESSION["contact_success"]);
        }
        ?>

        <form action="../Controller/process_contact.php" method="post">
            <label for="name">Your Name:</label>
            <input type="text" name="name" required>

            <label for="email">Your Email:</label>
            <input type="email" name="email" required>

            <label for="message">Message:</label>
            <textarea name="message" rows="5" required></textarea>

            <button type="submit">Send Message</button>
        </form>

        <div class="support-info">
            <h4>📞 Phone:</h4>
            <p>01618717196</p>

            <h4>✉️ Email:</h4>
            <p>library09@gmail.com</p>
        </div>

        <div class="back-container">
            <a class="back-link" href="dashboard_user.php">← Back to Dashboard</a>
        </div>
    </div>
</body>
</html>