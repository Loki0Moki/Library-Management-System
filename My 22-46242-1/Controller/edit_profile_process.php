<?php
session_start();
require_once("../Model/db_connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['user_id'])) {
    $name = trim($_POST['name']);
    $id = $_SESSION['user_id'];

    $stmt = $conn->prepare("UPDATE users SET name = ? WHERE id = ?");
    $stmt->bind_param("si", $name, $id);
    $stmt->execute();
    $_SESSION['name'] = $name;

    $stmt->close();
    $conn->close();
    header("Location: ../View/profile.php");
    exit();
}
?>
