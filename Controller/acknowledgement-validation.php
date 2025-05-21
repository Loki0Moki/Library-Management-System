<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ackName = trim($_POST["ackName"] ?? '');
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
        echo "<script>\n";
        echo "document.addEventListener('DOMContentLoaded', function() {\n";
        echo "  document.getElementById('ack-messages').innerText = '" . addslashes($error) . "';\n";
        echo "  document.getElementById('acknowledgmentLetter').style.display = 'none';\n";
        echo "  history.back();\n";
        echo "});\n";
        echo "</script>";
        exit;
    } else {
        echo '<!DOCTYPE html>';
        echo '<html lang="en">';
        echo '<head>';
        echo '  <meta charset="UTF-8">';
        echo '  <title>Acknowledgment Letter</title>';
        echo '  <link rel="stylesheet" href="../Assets/acknowledgement.css">';
        echo '</head>';
        echo '<body style="background:#fdf5e6;display:flex;justify-content:center;align-items:center;height:100vh;">';
        echo '  <div class="acknowledgment">';
        echo '    <h2>Thank You, ' . htmlspecialchars($ackName) . '!</h2>';
        echo '    <p>We sincerely appreciate your generous book donation to our library.<br>';
        echo '    Your support helps us enrich our collection and serve our community better.</p>';
        echo '    <p>Sincerely,<br>The Library Team</p>';
        echo '  </div>';
        echo '</body>';
        echo '</html>';
    }
} else {
    header("Location: ../View/acknowledgement.html");
    exit;
}
?>
