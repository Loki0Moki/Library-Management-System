<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>View Profile</title>
    <link rel="stylesheet" href="../Assets/viewProfile.css" />
</head>
<body>
    <header>
        <h1>Profile Management</h1>
    </header>
    <div class="container">
        <h2>Profile Info</h2>
        <p>Name: <span id="userName">[User Name]</span></p>
        <p>Email: <span id="userEmail">[user@example.com]</span></p>
        <a href="editProfile.php" class="button">Edit Profile</a><br>
        <a href="changeAvatar.php" class="button">Change Avatar</a><br>
        <a href="updatePassword.php" class="button">Update Password</a><br>
    </div>
    <script src="../Assets/viewProfile.js"></script>
</body>
</html>