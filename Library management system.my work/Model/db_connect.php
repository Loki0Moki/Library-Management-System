<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "library_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function insertLoan($conn, $user_id, $book_title, $borrow_date, $return_date) {
    $user_id = mysqli_real_escape_string($conn, $user_id);
    $book_title = mysqli_real_escape_string($conn, $book_title);
    $borrow_date = mysqli_real_escape_string($conn, $borrow_date);
    $return_date = mysqli_real_escape_string($conn, $return_date);

    $sql = "INSERT INTO loans (user_id, book_title, borrow_date, return_date, status)
            VALUES ('$user_id', '$book_title', '$borrow_date', '$return_date', 'On Loan')";
    
    return mysqli_query($conn, $sql);
}

function getBookDetailsByISBN($conn, $isbn) {
    $isbn = mysqli_real_escape_string($conn, $isbn);
    $sql = "SELECT title, author, genre, shelf FROM books WHERE isbn = '$isbn'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) === 1) {
        return mysqli_fetch_assoc($result); // returns associative array
    } else {
        return false; // not found
    }
}

function getUserPasswordHash($conn, $user_id) {
    $user_id = mysqli_real_escape_string($conn, $user_id);
    $sql = "SELECT password FROM users WHERE id = '$user_id'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        return $row['password'];
    }
    return false;
}

function updateUserPassword($conn, $user_id, $new_hashed_password) {
    $user_id = mysqli_real_escape_string($conn, $user_id);
    $escaped_password = mysqli_real_escape_string($conn, $new_hashed_password);
    $sql = "UPDATE users SET password = '$escaped_password' WHERE id = '$user_id'";
    return mysqli_query($conn, $sql);
}

function updateUserName($conn, $user_id, $name) {
    $user_id = mysqli_real_escape_string($conn, $user_id);
    $name = mysqli_real_escape_string($conn, $name);

    $sql = "UPDATE users SET name = '$name' WHERE id = '$user_id'";
    return mysqli_query($conn, $sql);
}

function updateUserName($conn, $user_id, $name) {
    $user_id = mysqli_real_escape_string($conn, $user_id);
    $name = mysqli_real_escape_string($conn, $name);

    $sql = "UPDATE users SET name = '$name' WHERE id = '$user_id'";
    return mysqli_query($conn, $sql);
}

function authenticateUser($conn, $email) {
    $email = mysqli_real_escape_string($conn, $email);
    $sql = "SELECT id, name, email, password, role FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) === 1) {
        return mysqli_fetch_assoc($result); // return user info as associative array
    }
    return false; // no user found
}

function registerUser($conn, $name, $email, $hashed_password, $role = 'user') {
    $name = mysqli_real_escape_string($conn, $name);
    $email = mysqli_real_escape_string($conn, $email);
    $hashed_password = mysqli_real_escape_string($conn, $hashed_password);
    $role = mysqli_real_escape_string($conn, $role);

    $sql = "INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$hashed_password', '$role')";
    
    if (mysqli_query($conn, $sql)) {
        return mysqli_insert_id($conn);
    }
    return false;
}

function returnBook($conn, $user_id, $book_title, $return_date) {
    $user_id = mysqli_real_escape_string($conn, $user_id);
    $book_title = mysqli_real_escape_string($conn, $book_title);
    $return_date = mysqli_real_escape_string($conn, $return_date);

    $sql = "UPDATE loans 
            SET status = 'Returned', actual_return = '$return_date' 
            WHERE user_id = '$user_id' AND book_title = '$book_title' AND status = 'On Loan'";

    return mysqli_query($conn, $sql);
}

?>

