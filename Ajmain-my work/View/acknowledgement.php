<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acknowledgment Generator</title>
    <link rel="stylesheet" href="../Assets/acknowledgement.css">
</head>
<body>
    <div class="container">
        <h1>Generate Acknowledgment Letter</h1>

        <form id="acknowledgmentForm" class="form-container">
            <label for="ackName">Donor Name:</label>
            <input type="text" id="ackName" name="ackName" placeholder="Enter donor's name">

            <button type="submit">Generate Letter</button>
        </form>

        <div id="ack-messages"></div>

        <div id="acknowledgmentLetter" class="acknowledgment" style="display:none;"></div>
    </div>

    <script src="../Assets/acknowledgement.js"></script>
</body>
</html>