<?php
$host = "localhost";
$user = "root";
$pass = ""; 
$db = "ajmain_db"; 

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


function insertUser($username, $email, $password) {
    global $conn;
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $email, $hashed_password);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
}


function validateUser($username, $password) {
    global $conn;
    $sql = "SELECT password FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
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