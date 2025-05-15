<?php
session_start();
require_once("../Model/db_connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];
    $confirm = $_POST["confirm_password"];

    if (empty($name) || empty($email) || empty($password) || empty($confirm)) {
        $_SESSION["register_error"] = "All fields are required.";
        header("Location: ../View/register.php");
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION["register_error"] = "Invalid email format.";
        header("Location: ../View/register.php");
        exit();
    }

    if ($password !== $confirm) {
        $_SESSION["register_error"] = "Passwords do not match.";
        header("Location: ../View/register.php");
        exit();
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $role = "user";

    $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $hashed_password, $role);

    if ($stmt->execute()) {
        $_SESSION["email"] = $email;
        $_SESSION["name"] = $name;
        $_SESSION["role"] = $role;
        $_SESSION["user_id"] = $stmt->insert_id;
        header("Location: ../View/dashboard_user.php");
    } else {
        $_SESSION["register_error"] = "Registration failed. Email might be taken.";
        header("Location: ../View/register.php");
    }

    $stmt->close();
    $conn->close();
}
?>
