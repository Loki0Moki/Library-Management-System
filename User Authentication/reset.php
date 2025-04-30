<?php

$errors = [];
$newPassword = '';
$confirmPassword = '';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $newPassword = trim($_POST['newPass'] ?? '');
    $confirmPassword = trim($_POST['confirmPass'] ?? '');

    
    if (empty($newPassword)) {
        $errors[] = "Error: New password cannot be empty. Please enter a password.";
    } elseif (strlen($newPassword) < 6) {
        $errors[] = "Error: Password must be at least 6 characters long.";
    }

    
    if (empty($confirmPassword)) {
        $errors[] = "Error: Confirm password cannot be empty. Please re-enter your password.";
    } elseif ($newPassword !== $confirmPassword) {
        $errors[] = "Error: Passwords do not match. Please try again.";
    }

    
    if (empty($errors)) {
        
        

        echo "<script>alert('Success: Password reset successfully!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reset Password</title>
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
  <form action="reset-password.php" method="POST">
    <h2>Reset Password</h2>

    
    <?php if (!empty($errors)): ?>
      <div class="errors">
        <ul>
          <?php foreach ($errors as $error): ?>
            <li><?php echo htmlspecialchars($error); ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>

    
    <input type="password" name="newPass" id="newPass" placeholder="New Password" value="<?php echo htmlspecialchars($newPassword ?? ''); ?>" required><br>

    
    <input type="password" name="confirmPass" id="confirmPass" placeholder="Confirm Password" value="<?php echo htmlspecialchars($confirmPassword ?? ''); ?>" required><br>

    
    <button type="submit">Reset</button>
  </form>
</body>
</html>
