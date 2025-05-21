<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST['email'] ?? '');
    $message = "";
    $valid = false;

    if ($email === "") {
        $message = "Email is required.";
    } elseif (strpos($email, '@') === false || strpos($email, '.') === false) {
        $message = "Invalid email format.";
    } else {
        $valid = true;
        $message = "A password reset link has been sent to: $email";
        
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Reset Link Sent</title>
  <link rel="stylesheet" href="../Assets/forgot.css">
</head>
<body>

<h2>Password Reset</h2>

<div style="color: <?= $valid ? 'green' : 'red' ?>;">
  <?= htmlspecialchars($message) ?>
</div>

<a href="../View/forgot.html">← Back to Forgot Page</a>

</body>
</html>
