<?php
header('Content-Type: application/json');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $contentType = $_SERVER["CONTENT_TYPE"] ?? '';
    if (stripos($contentType, 'application/json') !== false) {
        $raw = file_get_contents('php://input');
        $data = json_decode($raw, true);
        $ackName = trim($data["ackName"] ?? '');
    } else {
        $ackName = trim($_POST["ackName"] ?? '');
    }
    $error = "";

    if (empty($ackName)) {
        $error = "Donor name is required.";
    }
    elseif (!ctype_alpha(str_replace(' ', '', $ackName))) {
        $error = "Donor name should only contain letters and spaces.";
    }
    elseif (strlen($ackName) < 2) {
        $error = "Donor name must be at least 2 characters long.";
    } elseif (strlen($ackName) > 50) {
        $error = "Donor name must not exceed 50 characters.";
    }

    if (!empty($error)) {
        echo json_encode([
            'success' => false,
            'error' => $error
        ]);
        exit;
    } else {
        $letter = '<div class="acknowledgment">'
            . '<h2 class="text-2xl font-semibold text-gray-800 mb-3">Thank You, ' . htmlspecialchars($ackName) . '!</h2>'
            . '<p class="text-gray-700 leading-relaxed mb-4">We sincerely appreciate your generous book donation to our library.<br>'
            . 'Your support helps us enrich our collection and serve our community better.</p>'
            . '<p class="text-gray-700 font-medium">Sincerely,<br>The Library Team</p>'
            . '</div>';

        echo json_encode([
            'success' => true,
            'letter' => $letter
        ]);
        exit;
    }
} else {
    echo json_encode([
        'success' => false,
        'error' => 'Invalid request.'
    ]);
    exit;
}
?>