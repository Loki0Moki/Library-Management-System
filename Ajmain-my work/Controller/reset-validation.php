<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newPass = $_POST['newPass'] ?? '';
    $confirmPass = $_POST['confirmPass'] ?? '';

    $errors = [];

    if (strlen($newPass) < 8) {
        $errors[] = "Password must be at least 8 characters.";
    }

    $hasLetter = false;
    $hasNumber = false;

    for ($i = 0; $i < strlen($newPass); $i++) {
        if (ctype_alpha($newPass[$i])) $hasLetter = true;
        if (ctype_digit($newPass[$i])) $hasNumber = true;
    }

    if (!$hasLetter || !$hasNumber) {
        $errors[] = "Password must contain both letters and numbers.";
    }

    if ($newPass !== $confirmPass) {
        $errors[] = "Passwords do not match.";
    }

    if (empty($errors)) {
        // If successful, redirect with success message
        $success = urlencode("Password reset successfully.");
        header("Location: ../View/resetPassword.php?success=$success");
    } else {
        // Redirect with error(s)
        $error = urlencode(implode(" ", $errors));
        header("Location: ../View/resetPassword.php?error=$error");
    }

    exit();
} else {
    header("Location: ../View/resetPassword.php?error=Invalid+request.");
    exit();
}
