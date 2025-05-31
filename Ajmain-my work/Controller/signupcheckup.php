<?php
session_start();
require_once '../Model/db_connect.php';

// Enable error reporting for debugging (you can remove in production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function validateSignupInputs($username, $email, $password, $confirm_password) {
    $errors = [];

    $username = trim($username ?? '');
    $email = trim($email ?? '');
    $password = $password ?? '';
    $confirm_password = $confirm_password ?? '';

    if ($username === '') {
        $errors[] = "Username is required.";
    } elseif (strlen($username) < 3) {
        $errors[] = "Username must be at least 3 characters.";
    }

    if ($email === '') {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    if ($password === '') {
        $errors[] = "Password is required.";
    } elseif (strlen($password) < 4) {
        $errors[] = "Password must be at least 4 characters.";
    }

    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match.";
    }

    return $errors;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    $errors = validateSignupInputs($username, $email, $password, $confirm_password);

    if (!empty($errors)) {
        foreach ($errors as $e) {
            echo "<p style='color:red'>" . htmlspecialchars($e) . "</p>";
        }
        echo "<a href='../View/signup.php'>← Back to Signup</a>";
        exit();
    }

    // Attempt to insert user
    if (insertUser($username, $email, $password)) {
        // Signup successful
        header('Location: ../View/login.php');
        exit();
    } else {
        // Insertion failed — could be duplicate username/email
        echo "<p style='color:red'>Signup failed. Username or email might already exist.</p>";
        echo "<a href='../View/signup.php'>← Back to Signup</a>";
        exit();
    }
} else {
    // Invalid access — redirect
    header('Location: ../View/signup.php');
    exit();
}
