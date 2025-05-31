<?php
session_start();
require_once("../Model/db_connect.php");

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_SESSION['user_id'])) {
    $loan_id = mysqli_real_escape_string($conn, $_POST['loan_id']);
    $return_date = mysqli_real_escape_string($conn, $_POST['return_date']);
    $user_id = $_SESSION['user_id'];

    // Step 1: Get the expected return date
    $sql = "SELECT return_date FROM loans WHERE id = '$loan_id' AND user_id = '$user_id'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        $expected_return_date = new DateTime($row['return_date']);
        $actual_return_date = new DateTime($return_date);

        $fine = 0;
        if ($actual_return_date > $expected_return_date) {
            $interval = $actual_return_date->diff($expected_return_date);
            $days_late = $interval->days;

            if ($days_late > 2) {
                $fine = ($days_late - 2) * 20; // fine starts after 2-day grace
            }
        }

        // Step 2: Update loan with return status, date, and fine
        $update_sql = "UPDATE loans 
                       SET status = 'Returned', 
                           actual_return = '$return_date',
                           fine_amount = '$fine'
                       WHERE id = '$loan_id' AND user_id = '$user_id' AND status = 'On Loan'";

        if (mysqli_query($conn, $update_sql) && mysqli_affected_rows($conn) > 0) {
            $_SESSION['loan_message'] = "✅ Book returned successfully.";
        } else {
            $_SESSION['loan_message'] = "❌ Failed to update return.";
        }
    } else {
        $_SESSION['loan_message'] = "❌ Loan not found.";
    }

    header("Location: ../View/view_loans.php");
    exit();
} else {
    header("Location: ../View/view_loans.php");
    exit();
}