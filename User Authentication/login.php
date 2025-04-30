<?php

$errors = [];
$email = '';
$password = '';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    $email = trim($_POST['loginEmail'] ?? '');
    $password = trim($_POST['loginPass'] ?? '');

    
    if (empty($email)) {
        $errors[] = "Error: Email field cannot be empty. Please enter your email.";
    } elseif (strpos($email, '@') === false || strpos($email, '.') === false) {
        $errors[] = "Error: Invalid email address. Please enter a valid email.";
    }

   
    if (empty($password)) {
        $errors[] = "Error: Password field cannot be empty. Please enter your password.";
    } elseif (strlen($password) < 6) {
        $errors[] = "Error: Password must be at least 6 characters long.";
    }

    
    if (empty($errors)) {
        
        session_start();
        $_SESSION['userEmail'] = $email;
        $_SESSION['userName'] = 'Ajmain Abrar';  
        echo "<script>alert('Success: Login successful!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
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

    p {
      text-align: center;
      margin-top: 10px;
    }

    a {
      color: #007bff;
      text-decoration: none;
    }

    a:hover {
      text-decoration: underline;
    }

    .errors {
      color: red;
      font-size: 14px;
    }
  </style>
</head>
<body>
  <form action="login.php" method="POST">
    <h2>Login</h2>

    
    <?php if (!empty($errors)): ?>
      <div class="errors">
        <ul>
          <?php foreach ($errors as $error): ?>
            <li><?php echo htmlspecialchars($error); ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>

    
    <input type="email" name="loginEmail" id="loginEmail" placeholder="Email" value="<?php echo htmlspecialchars($email ?? ''); ?>" required><br>

    
    <input type="password" name="loginPass" id="loginPass" placeholder="Password" value="<?php echo htmlspecialchars($password ?? ''); ?>" required><br>

    
    <button type="submit">Login</button>
    <p><a href="forgot.html">Forgot Password?</a></p>
  </form>
</body>
</html>
