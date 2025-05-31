<?php
session_start();
require_once("../Model/db_connect.php");

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("Location: ../View/login.php");
    exit();
}

if (isset($_GET['loan_id'])) {
    $loan_id = mysqli_real_escape_string($conn, $_GET['loan_id']);
    $user_id = $_SESSION['user_id'];

    // Only delete if the loan belongs to the user and is not returned yet
    $sql = "DELETE FROM loans WHERE id = '$loan_id' AND user_id = '$user_id' AND status = 'On Loan'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_affected_rows($conn) > 0) {
        $_SESSION['loan_message'] = "✅ Loan deleted successfully.";
    } else {
        $_SESSION['loan_message'] = "❌ Could not delete loan. It may already be returned.";
    }
} else {
    $_SESSION['loan_message'] = "❌ Invalid request.";
}

header("Location: ../View/view_loans.php");
exit();
