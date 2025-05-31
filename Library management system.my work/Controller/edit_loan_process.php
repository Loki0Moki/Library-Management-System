<?php
session_start();
require_once("../Model/db_connect.php");

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("Location: ../View/login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['loan_id'], $_POST['return_date'])) {
    $loan_id = mysqli_real_escape_string($conn, $_POST['loan_id']);
    $new_return_date = mysqli_real_escape_string($conn, $_POST['return_date']);
    $user_id = $_SESSION['user_id'];

    // Update loan return date
    $sql = "UPDATE loans 
            SET return_date = '$new_return_date' 
            WHERE id = '$loan_id' AND user_id = '$user_id'";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['loan_message'] = "Loan updated successfully.";
    } else {
        $_SESSION['loan_message'] = "Error updating loan: " . mysqli_error($conn);
    }

    header("Location: ../View/view_loans.php");
    exit();
} else {
    $_SESSION['loan_message'] = "Invalid request.";
    header("Location: ../View/view_loans.php");
    exit();
}
