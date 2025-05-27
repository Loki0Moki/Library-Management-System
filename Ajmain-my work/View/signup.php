<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Signup</title>
  <link rel="stylesheet" href="../Assets/signup.css">
</head>
<body>
  <form action="verify.php" onsubmit="return validateSignup()">
    
    <div class="login-container">
       
    <h2>Signup</h2>
    <input type="email" id="signupEmail" placeholder="Email" required><br>
    <input type="password" id="signupPass" placeholder="Password" required><br>
    <input type="password" id="signupConfirm" placeholder="Confirm Password" required><br>
    <div id="signupError" style="color:red;margin-bottom:10px;"></div>
    <button type="submit">Signup</button>
  </form>
  <p>Already have an account? <a href="login.php">Login</a></p>

  <script src="../Assets/signup.js"></script>
</body>
</html>