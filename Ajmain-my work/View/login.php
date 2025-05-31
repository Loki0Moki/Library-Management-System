<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Library Login</title>
    <link rel="stylesheet" href="../Assets/login.css" />
</head>
<body>
    <div class="login-container">
        <h1>Library Login</h1>
        <form action="../Controller/loginCheck.php" method="post" autocomplete="off">
            <input type="text" name="username" placeholder="Username" required />
            <input type="password" name="password" placeholder="Password" required />
            <div style="width:100%;display:flex;align-items:center;justify-content:space-between;margin-bottom:18px;">
                <label style="font-size:0.95rem;">
                    <input type="checkbox" name="remember" style="margin-right:6px;" /> Remember me
                </label>
                <a href="forgot.php" style="font-size:0.95rem;margin:0;">Forgot?</a>
            </div>
            <input type="submit" name="submit" value="Login" />
        </form>
        <a href="signup.php">Don't have an account? Sign up</a>
    </div>
    <script src="../Assets/login.js"></script>
</body>
</html>
