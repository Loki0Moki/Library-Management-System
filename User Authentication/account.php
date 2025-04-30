<?php

$errors = [];


$userName = 'Ajmain';
$userEmail = 'ajmain@example.com';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    if (empty($userName)) {
        $errors[] = "Username is required.";
    } elseif (!ctype_alnum($userName)) {
        $errors[] = "Username must contain only letters and numbers.";
    }

    
    if (empty($userEmail)) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Account</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background: url('library.jpg') no-repeat center center fixed;
      background-size: cover;
      color: #fff;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .account-container {
      background: rgba(0, 0, 0, 0.7);
      padding: 20px;
      border-radius: 8px;
      text-align: center;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
      width: 400px;
    }

    h2 {
      margin-bottom: 10px;
      font-size: 24px;
    }

    p {
      font-size: 16px;
    }

    .errors {
      color: red;
      font-size: 14px;
    }
  </style>
</head>
<body>
  <div class="account-container">
    <h2>Welcome to your account!</h2>
    
    <!-- Show any validation errors if they exist -->
    <?php if (!empty($errors)): ?>
      <div class="errors">
        <ul>
          <?php foreach ($errors as $error): ?>
            <li><?php echo htmlspecialchars($error); ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php else: ?>
      <p id="statusMessage">You have successfully logged in.</p>
    <?php endif; ?>
    
  </div>

  

</body>
</html>
