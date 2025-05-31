<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "ajmain_login";


$conn = new mysqli($host, $user, $pass, $db);


if ($conn->connect_error) {
    error_log("Database connection failed: " . $conn->connect_error);
    exit('Database connection error. Please try again later.');
}


$conn->set_charset("utf8mb4");


function insertUser($username, $email, $password) {
    global $conn;
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if (!$stmt) return false;
    $stmt->bind_param("sss", $username, $email, $hashed_password);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
}


function validateUser($username, $password) {
    global $conn;
    $sql = "SELECT password FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) return false;
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashed_password);
        $stmt->fetch();
        $stmt->close();
        return password_verify($password, $hashed_password);
    } else {
        $stmt->close();
        return false;
    }
}
?>
