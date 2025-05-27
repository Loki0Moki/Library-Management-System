<?php
session_start();
require_once("../Model/db_connect.php");

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_SESSION['user_id'])) {
    $loan_id = intval($_POST['loan_id']);

    // Update the return date + 7 days
    $stmt = $conn->prepare("UPDATE loans SET return_date = DATE_ADD(return_date, INTERVAL 7 DAY) WHERE id = ? AND status = 'On Loan'");
    $stmt->bind_param("i", $loan_id);
    $success = $stmt->execute();
    $stmt->close();

    if ($success) {
        // Get the new return date
        $stmt2 = $conn->prepare("SELECT return_date FROM loans WHERE id = ?");
        $stmt2->bind_param("i", $loan_id);
        $stmt2->execute();
        $stmt2->bind_result($new_due_date);
        $stmt2->fetch();
        $stmt2->close();

        echo json_encode(["success" => true, "new_due_date" => $new_due_date]);
    } else {
        echo json_encode(["success" => false, "message" => "Could not renew."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Unauthorized."]);
}
?>
