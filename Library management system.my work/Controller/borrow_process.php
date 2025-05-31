<?php
session_start();
require_once("../Model/db_connect.php");

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_SESSION['user_id'])) {
    // Sanitize user inputs
    $book_id = mysqli_real_escape_string($conn, $_POST['book_id']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $borrow_date = mysqli_real_escape_string($conn, $_POST['borrow_date']);
    $return_date = mysqli_real_escape_string($conn, $_POST['return_date']);
    $user_id = mysqli_real_escape_string($conn, $_SESSION['user_id']);

    // Check if the book is already borrowed and not returned
    $check_sql = "SELECT * FROM loans 
                  WHERE user_id = '$user_id' 
                    AND book_id = '$book_id' 
                    AND status = 'On Loan'";

    $check_result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($check_result) > 0) {
        $_SESSION['loan_message'] = "❌ You already borrowed this book.";
        header("Location: ../View/view_loans.php");
        exit();
    }

    // Insert new loan
    $insert_sql = "INSERT INTO loans (user_id, book_id, book_title, borrow_date, return_date, status)
                   VALUES ('$user_id', '$book_id', '$title', '$borrow_date', '$return_date', 'On Loan')";

    if (mysqli_query($conn, $insert_sql)) {
        $_SESSION['loan_message'] = "✅ Book borrowed successfully.";
    } else {
        $_SESSION['loan_message'] = "❌ Error: " . mysqli_error($conn);
    }

    header("Location: ../View/view_loans.php");
    exit();
} else {
    header("Location: ../View/dashboard_user.php");
    exit();
}