<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Registration</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; }
        form { max-width: 400px; margin: 0 auto; }
        label, input, button { display: block; width: 100%; margin-bottom: 10px; padding: 8px; }
        button { background-color: #4CAF50; color: white; border: none; }
        button:hover { background-color: #45a049; }
    </style>
</head>
<body>

<h2>Library Registration Form</h2>

<?php
// Initialize variables for errors and form values
$fullName = $dob = $address = $contact = $idProof = "";
$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect form data and validate
    $fullName = trim($_POST['fullName']);
    $dob = $_POST['dob'];
    $address = trim($_POST['address']);
    $contact = trim($_POST['contact']);
    $idProof = $_FILES['idProof'];

    // Validation
    if (empty($fullName)) {
        $errors[] = "Full Name is required.";
    }
    if (empty($dob)) {
        $errors[] = "Date of Birth is required.";
    }
    if (empty($address)) {
        $errors[] = "Address is required.";
    }
    if (empty($contact)) {
        $errors[] = "Contact Number is required.";
    }
    if (empty($idProof['name'])) {
        $errors[] = "ID Proof is required.";
    }

    // If no errors, proceed with registration (for now, display success message)
    if (empty($errors)) {
        // Generate Library Card Number (this could be saved to a database)
        $libraryCardNumber = 'LIB-' . mt_rand(100000, 999999);
        echo "<p style='color: green;'>Registration successful! Your Library Card Number is: $libraryCardNumber</p>";
    }
}
?>

<form id="registrationForm" method="post" enctype="multipart/form-data">
    <label for="fullName">Full Name</label>
    <input type="text" id="fullName" name="fullName" value="<?php echo htmlspecialchars($fullName); ?>" required>

    <label for="dob">Date of Birth</label>
    <input type="date" id="dob" name="dob" value="<?php echo htmlspecialchars($dob); ?>" required>

    <label for="address">Address</label>
    <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($address); ?>" required>

    <label for="contact">Contact Number</label>
    <input type="tel" id="contact" name="contact" value="<?php echo htmlspecialchars($contact); ?>" required>

    <label for="idProof">Upload ID Proof</label>
    <input type="file" id="idProof" name="idProof" required>

    <?php
    // Display errors if there are any
    if (!empty($errors)) {
        echo '<ul style="color: red;">';
        foreach ($errors as $error) {
            echo "<li>$error</li>";
        }
        echo '</ul>';
    }
    ?>

    <button type="submit">Register</button>
</form>
</body>
</html>
