<?php
$branch = $_POST['branch'] ?? '';
$period = $_POST['period'] ?? '';

if ($branch === '' || $period === '') {
    $error = urlencode("Both fields are required.");
    header("Location: ../View/reportWizard.html?error=$error");
    exit;
}

// Passed validation — redirect to result page with data
header("Location: ../View/reportResult.html?branch=" . urlencode($branch) . "&period=" . urlencode($period));
exit;
