<?php
session_start();
require_once("../Model/db_connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['user_id'])) {
    $title = $_POST['title'];
    $return_date = $_POST['return_date'];
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("UPDATE loans SET status = 'Returned', actual_return = ? WHERE user_id = ? AND book_title = ? AND status = 'On Loan'");
    $stmt->bind_param("sis", $return_date, $user_id, $title);
    $stmt->execute();
    $stmt->close();

    $_SESSION['loan_message'] = "Book returned successfully.";
    header("Location: ../View/view_loans.php");
    exit();
}
?>
