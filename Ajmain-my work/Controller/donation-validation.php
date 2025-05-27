<?php

$name = $_POST['donorName'] ?? '';
$email = $_POST['email'] ?? '';
$bookTitle = $_POST['bookTitle'] ?? '';
$condition = $_POST['condition'] ?? '';
$notes = $_POST['notes'] ?? '';


if ($name === '' || $email === '' || $bookTitle === '' || $condition === '') {
    $error = urlencode("All required fields must be filled out.");
    header("Location: ../View/donationForm.php?error=$error");
    exit;
}


if (is_numeric($name)) {
    $error = urlencode("Name cannot be only numbers.");
    header("Location: ../View/donationForm.php?error=$error&donorName=" . urlencode($name));
    exit;
}


$validConditions = ['New', 'Good', 'Fair', 'Poor'];
if (!in_array($condition, $validConditions)) {
    $error = urlencode("Invalid book condition selected.");
    header("Location: ../View/donationForm.php?error=$error");
    exit;
}




