<?php
session_start();
require_once("../Model/db_connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and escape input
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $message = mysqli_real_escape_string($conn, $_POST["message"]);

    // Insert into database
    $sql = "INSERT INTO contact_messages (name, email, message) 
            VALUES ('$name', '$email', '$message')";

    if (mysqli_query($conn, $sql)) {
        $_SESSION["contact_success"] = "✅ Thank you! Your message has been successfully sent.";
    } else {
        $_SESSION["contact_success"] = "❌ Error: Could not send message. Please try again later.";
    }

    // Redirect back to the contact page
    header("Location: ../View/contact_us.php");
    exit();
} else {
    // If accessed directly, redirect
    header("Location: ../View/contact_us.php");
    exit();
}
?>
