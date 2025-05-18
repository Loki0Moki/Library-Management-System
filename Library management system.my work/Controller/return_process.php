<?php
session_start();
require_once("../Model/db_connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['user_id'])) {
    $title = $_POST['title'];
    $return_date = $_POST['return_date'];
    $user_id = $_SESSION['user_id'];

    if (returnBook($conn, $user_id, $title, $return_date)) {
        $_SESSION['loan_message'] = "Book returned successfully.";
    } else {
        $_SESSION['loan_message'] = "Failed to return book.";
    }

    header("Location: ../View/view_loans.php");
    exit();
}
?>
