<?php
session_start();
require_once("../Model/db_connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['user_id'])) {
    $title = $_POST['title'];
    $borrow_date = $_POST['borrow_date'];
    $return_date = $_POST['return_date'];
    $user_id = $_SESSION['user_id'];

    if (insertLoan($conn, $user_id, $title, $borrow_date, $return_date)) {
        $_SESSION['loan_message'] = "Book borrowed successfully.";
    } else {
        $_SESSION['loan_message'] = "Error borrowing book: " . mysqli_error($conn);
    }

    header("Location: ../View/view_loans.php");
    exit();
}
?>

