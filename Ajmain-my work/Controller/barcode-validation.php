<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $isbn = trim($_POST['isbn'] ?? '');

    $message = "";
    $valid = false;

    
    if ($isbn === "") {
        $message = "ISBN is required.";
    }
    
    elseif (!ctype_digit(str_replace('-', '', $isbn))) {
        $message = "ISBN must contain only numbers or dashes.";
    }
    else {
        $cleanIsbn = str_replace('-', '', $isbn);
        $length = strlen($cleanIsbn);

        if ($length !== 10 && $length !== 13) {
            $message = "ISBN must be either 10 or 13 digits.";
        } else {
            $valid = true;
            $message = "Valid ISBN: $isbn";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>ISBN Validation Result</title>
  <link rel="stylesheet" href="../Assets/barcode.css">
</head>
<body>

<h1>ISBN Validation Result</h1>

<?php if (isset($valid)): ?>
  <div style="color: <?= $valid ? 'green' : 'red' ?>;">
    <?= htmlspecialchars($message) ?>
  </div>
<?php endif; ?>

<a href="../View/barcodeScanner.php">Go Back</a>

</body>
</html>
