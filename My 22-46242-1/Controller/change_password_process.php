<?php
session_start();
require_once("../Model/db_connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['user_id'])) {
    $id = $_SESSION['user_id'];
    $current = $_POST['current_password'];
    $new = $_POST['new_password'];
    $confirm = $_POST['confirm_password'];

    if ($new !== $confirm) {
        $_SESSION['pass_error'] = "Passwords do not match.";
        header("Location: ../View/change_password.php");
        exit();
    }

    $stmt = $conn->prepare("SELECT password FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($hashed);
    $stmt->fetch();
    $stmt->close();

    if (password_verify($current, $hashed)) {
        $new_hashed = password_hash($new, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
        $stmt->bind_param("si", $new_hashed, $id);
        $stmt->execute();
        $stmt->close();
        $_SESSION['pass_success'] = "Password updated.";
    } else {
        $_SESSION['pass_error'] = "Incorrect current password.";
    }

    header("Location: ../View/change_password.php");
    exit();
}
?>
