<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = $_POST['password'] ?? '';

    $errors = [];

    if (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters.";
    }

    $hasLetter = false;
    $hasNumber = false;

    for ($i = 0; $i < strlen($password); $i++) {
        if (ctype_alpha($password[$i])) $hasLetter = true;
        if (ctype_digit($password[$i])) $hasNumber = true;
    }

    if (!$hasLetter || !$hasNumber) {
        $errors[] = "Password must include both letters and numbers.";
    }

    if (empty($errors)) {
        $success = urlencode("Password updated successfully.");
        header("Location: ../View/updatePassword.html?success=$success");
    } else {
        $error = urlencode(implode(" ", $errors));
        header("Location: ../View/updatePassword.html?error=$error");
    }

    exit();
} else {
    header("Location: ../View/updatePassword.html?error=Invalid+request+method.");
    exit();
}
?>
