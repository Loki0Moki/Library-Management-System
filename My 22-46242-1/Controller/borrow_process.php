<?php
session_start();
require_once("../Model/db_connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['user_id'])) {
    $title = $_POST['title'];
    $borrow_date = $_POST['borrow_date'];
    $return_date = $_POST['return_date'];
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("INSERT INTO loans (user_id, book_title, borrow_date, return_date, status) VALUES (?, ?, ?, ?, 'On Loan')");
    $stmt->bind_param("isss", $user_id, $title, $borrow_date, $return_date);
    $stmt->execute();
    $stmt->close();

    $_SESSION['loan_message'] = "Book borrowed successfully.";
    header("Location: ../View/view_loans.php");
    exit();
}
?>
