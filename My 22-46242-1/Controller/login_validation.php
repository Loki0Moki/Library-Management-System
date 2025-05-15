<?php
session_start();
require_once("../Model/db_connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    if (empty($email) || empty($password)) {
        $_SESSION["error"] = "Email and password are required.";
        header("Location: ../View/login.php");
        exit();
    }

    // Sanitize and prepare SQL
    $stmt = $conn->prepare("SELECT id, name, email, password, role FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($id, $name, $email_db, $hashed_password, $role);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION["user_id"] = $id;
            $_SESSION["name"] = $name;
            $_SESSION["email"] = $email_db;
            $_SESSION["role"] = $role;

            if ($role == "admin") {
                header("Location: ../View/dashboard_admin.php");
            } else {
                header("Location: ../View/dashboard_user.php");
            }
            exit();
        } else {
            $_SESSION["error"] = "Invalid password.";
        }
    } else {
        $_SESSION["error"] = "No account found with that email.";
    }

    $stmt->close();
    $conn->close();
    header("Location: ../View/login.php");
    exit();
} else {
    header("Location: ../View/login.php");
    exit();
}
?>
