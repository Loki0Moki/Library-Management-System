<?php


function validateLoginInputs($username, $password) {
    $username = trim($username ?? '');
    $password = $password ?? '';
    $errors = [];

    if ($username === '') {
        $errors[] = "Username is required.";
    } elseif (strlen($username) < 3) {
        $errors[] = "Username must be at least 3 characters.";
    }

    if ($password === '') {
        $errors[] = "Password is required.";
    } elseif (strlen($password) < 4) {
        $errors[] = "Password must be at least 4 characters.";
    }

    return $errors;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = validateLoginInputs($_POST['username'], $_POST['password']);

    if (!empty($errors)) {
        foreach ($errors as $e) {
            echo "<p style='color:red'>" . htmlspecialchars($e) . "</p>";
        }
        echo "<a href='../View/login.html'>← Back to Login</a>";
    } else {
        echo "<p style='color:green'>Input validation passed (no session logic here).</p>";
    }
}
?>