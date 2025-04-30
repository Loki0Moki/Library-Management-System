<?php

$errors = [];


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $email = trim($_POST['forgotEmail'] ?? '');

    
    if (empty($email)) {
        $errors[] = "Error: Email field cannot be empty. Please enter your email.";
    } elseif (strpos($email, '@') === false || strpos($email, '.') === false) {
        $errors[] = "Error: Invalid email address. Please enter a valid email.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Forgot Password</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f9;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    h2 {
      text-align: center;
      color: #333;
      margin-bottom: 20px;
    }

    form {
      background: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      width: 300px;
    }

    input {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 4px;
      font-size: 14px;
    }

    button {
      width: 100%;
      padding: 10px;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 4px;
      font-size: 16px;
      cursor: pointer;
    }

    button:hover {
      background-color: #0056b3;
    }

    .errors {
      color: red;
      font-size: 14px;
    }
  </style>
</head>
<body>
  <form action="forgot-password.php" method="post">
    <h2>Forgot Password</h2>

    
    <?php if (!empty($errors)): ?>
      <div class="errors">
        <ul>
          <?php foreach ($errors as $error): ?>
            <li><?php echo htmlspecialchars($error); ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>

    
    <input type="email" name="forgotEmail" id="forgotEmail" placeholder="Enter your email" value="<?php echo htmlspecialchars($email ?? ''); ?>" required><br>

   
    <button type="submit">Send Reset Link</button>
  </form>
</body>
</html>
