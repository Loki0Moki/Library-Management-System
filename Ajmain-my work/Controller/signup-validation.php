<?php
function validateSignupInputs($fullName, $email, $password, $confirm) {
    $fullName = trim($fullName ?? '');
    $email = trim($email ?? '');
    $password = $password ?? '';
    $confirm = $confirm ?? '';
    $errors = [];

    // Full Name checks
    if ($fullName === '' || strlen($fullName) < 2) {
        $errors[] = "Full Name must be at least 2 characters.";
    }

    // Email checks (without regex)
    if ($email === '') {
        $errors[] = "Email is required.";
    } elseif (strpos($email, '@') === false || strpos($email, '.') === false || strlen($email) < 6) {
        $errors[] = "Invalid email format.";
    }

    if (strlen($password) < 4) {
        $errors[] = "Password must be at least 4 characters.";
    }

    if ($password !== $confirm) {
        $errors[] = "Passwords do not match.";
    }

    return $errors;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = validateSignupInputs($_POST['fullname'], $_POST['email'], $_POST['password'], $_POST['confirm']);

    if (!empty($errors)) {
        foreach ($errors as $err) {
            echo "<p style='color:red'>" . htmlspecialchars($err) . "</p>";
        }
        echo "<a href='../View/signup.php'>← Back to Signup</a>";
    } else {
        echo "<p style='color:green'>Validation passed. Proceed to verify.</p>";
    }
}
?>