<?php
session_start();
require_once("../Model/db_connect.php");

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../View/register.php");
    exit();
}

// Collect form input
$name = trim($_POST["name"]);
$email = trim($_POST["email"]);
$password = $_POST["password"];
$confirm = $_POST["confirm_password"];

// Validate form input
if (empty($name) || empty($email) || empty($password) || empty($confirm) || empty($_FILES['id_proof'])) {
    $_SESSION["register_error"] = "All fields including ID proof are required.";
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

// Check for duplicate email
$email_escaped = mysqli_real_escape_string($conn, $email);
$sql = "SELECT id FROM users WHERE email = '$email_escaped'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $_SESSION["register_error"] = "This email is already registered.";
    header("Location: ../View/register.php");
    exit();
}
mysqli_free_result($result);

// Upload ID proof
$upload_dir = "../uploads/id_proofs/";
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

$filename = time() . "_" . basename($_FILES['id_proof']['name']);
$target_file = $upload_dir . $filename;

if (!move_uploaded_file($_FILES['id_proof']['tmp_name'], $target_file)) {
    $_SESSION["register_error"] = "Failed to upload ID proof.";
    header("Location: ../View/register.php");
    exit();
}

// Prepare and insert user data
$role = "user";
$library_card_number = "LIB-" . strtoupper(uniqid());
$name_escaped = mysqli_real_escape_string($conn, $name);
$password_escaped = mysqli_real_escape_string($conn, $password);
$id_proof_escaped = mysqli_real_escape_string($conn, $target_file);
$role_escaped = mysqli_real_escape_string($conn, $role);
$card_escaped = mysqli_real_escape_string($conn, $library_card_number);

$insert_sql = "INSERT INTO users (name, email, id_proof, password, role, library_card_number)
               VALUES ('$name_escaped', '$email_escaped', '$id_proof_escaped', '$password_escaped', '$role_escaped', '$card_escaped')";

if (mysqli_query($conn, $insert_sql)) {
    $_SESSION["library_card_number"] = $library_card_number;
    header("Location: ../View/welcome_library_card.php");
    exit();
} else {
    $_SESSION["register_error"] = "Registration failed. Please try again.";
    header("Location: ../View/register.php");
    exit();
}

mysqli_close($conn);
