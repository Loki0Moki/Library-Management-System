<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Library Signup</title>
    <link rel="stylesheet" href="../Assets/login.css" />
</head>
<body>
    <div class="login-container">
        <h1>Sign Up</h1>
        <form action="../Controller/signupCheck.php" method="post" autocomplete="off">
            <input type="text" name="username" placeholder="Username" required />
            <input type="password" name="password" placeholder="Password" required />
            <input type="password" name="confirm_password" placeholder="Confirm Password" required />
            <input type="submit" name="submit" value="Sign Up" />
        </form>
        <a href="login.php">Already have an account? Login</a>
      
    </div>
    <script src="../Assets/signup.js"></script>
</body>
</html>
