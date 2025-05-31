<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "library_db";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// === Loan Functions ===
function insertLoan($conn, $user_id, $book_title, $borrow_date, $return_date) {
    $user_id = mysqli_real_escape_string($conn, $user_id);
    $book_title = mysqli_real_escape_string($conn, $book_title);
    $borrow_date = mysqli_real_escape_string($conn, $borrow_date);
    $return_date = mysqli_real_escape_string($conn, $return_date);

    $sql = "INSERT INTO loans (user_id, book_title, borrow_date, return_date, status)
            VALUES ('$user_id', '$book_title', '$borrow_date', '$return_date', 'On Loan')";
    return mysqli_query($conn, $sql);
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

function getReturnedLoans($conn, $user_id) {
    $user_id = mysqli_real_escape_string($conn, $user_id);
    $sql = "SELECT id, book_title, borrow_date, return_date, actual_return, status 
            FROM loans 
            WHERE user_id = '$user_id' AND status = 'Returned' 
            ORDER BY actual_return DESC";
    $result = mysqli_query($conn, $sql);
    $loans = [];

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $loans[] = $row;
        }
    }

    return $loans;
}

/* function getUserLoans($conn, $user_id) {
    $user_id = mysqli_real_escape_string($conn, $user_id);
    $sql = "SELECT id, book_title, borrow_date, return_date, status 
            FROM loans 
            WHERE user_id = '$user_id' 
            ORDER BY borrow_date DESC";
    $result = mysqli_query($conn, $sql);
    $loans = [];

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $loans[] = $row;
        }
    }

    return $loans; 
} */

// === Book Functions ===
function getBookDetailsByISBN($conn, $isbn) {
    $isbn = mysqli_real_escape_string($conn, $isbn);
    $sql = "SELECT title, author, genre, shelf FROM books WHERE isbn = '$isbn'";
    $result = mysqli_query($conn, $sql);
    return ($result && mysqli_num_rows($result) === 1) ? mysqli_fetch_assoc($result) : false;
}

function searchBooks($conn, $keyword = '', $category = '') {
    $query = "SELECT * FROM books WHERE 1";
    $params = [];
    $types = '';

    if (!empty($keyword)) {
        $query .= " AND (title LIKE ? OR author LIKE ?)";
        $k = "%" . $keyword . "%";
        $params[] = $k;
        $params[] = $k;
        $types .= "ss";
    }

    if (!empty($category)) {
        $query .= " AND genre = ?";
        $params[] = $category;
        $types .= "s";
    }

    $stmt = $conn->prepare($query);
    if (!empty($params)) {
        $stmt->bind_param($types, ...$params);
    }

    $stmt->execute();
    return $stmt->get_result();
}

// === User Account Functions ===
function getUserPasswordHash($conn, $user_id) {
    $user_id = mysqli_real_escape_string($conn, $user_id);
    $sql = "SELECT password FROM users WHERE id = '$user_id'";
    $result = mysqli_query($conn, $sql);
    return ($result && mysqli_num_rows($result) === 1) ? mysqli_fetch_assoc($result)['password'] : false;
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

function emailExists($conn, $email) {
    $email = mysqli_real_escape_string($conn, $email);
    $sql = "SELECT id FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    return mysqli_num_rows($result) > 0;
}

function authenticateUser($conn, $email) {
    $email = mysqli_real_escape_string($conn, $email);
    $sql = "SELECT id, name, email, password, role FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    return ($result && mysqli_num_rows($result) === 1) ? mysqli_fetch_assoc($result) : false;
}

function registerUser($conn, $name, $email, $hashed_password, $role = 'user') {
    $name = mysqli_real_escape_string($conn, $name);
    $email = mysqli_real_escape_string($conn, $email);
    $hashed_password = mysqli_real_escape_string($conn, $hashed_password);
    $role = mysqli_real_escape_string($conn, $role);

    $sql = "INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$hashed_password', '$role')";
    return mysqli_query($conn, $sql) ? mysqli_insert_id($conn) : false;
}

// === Fine Functions ===
function calculateUserFines($conn, $user_id, $rate_per_day = 20) {
    $user_id = mysqli_real_escape_string($conn, $user_id);
    $today = date('Y-m-d');
    $fine_details = [];
    $total_fine = 0;

    $sql = "SELECT book_title, return_date FROM loans WHERE user_id = '$user_id' AND status = 'On Loan'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $days_overdue = (strtotime($today) - strtotime($row['return_date'])) / (60 * 60 * 24);
            if ($days_overdue > 0) {
                $fine = floor($days_overdue) * $rate_per_day;
                $total_fine += $fine;
                $fine_details[] = [
                    'title' => $row['book_title'],
                    'days' => floor($days_overdue),
                    'fine' => $fine
                ];
            }
        }
    }

    return ['total' => $total_fine, 'details' => $fine_details];
}

/* function calculateTotalFineByUserId($conn, $user_id, $rate_per_day = 20) {
    $today = date('Y-m-d');
    $total_fine = 0;

    $sql = "SELECT return_date FROM loans WHERE user_id = ? AND status = 'On Loan'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $return_date = $row['return_date'];
        $days_overdue = (strtotime($today) - strtotime($return_date)) / (60 * 60 * 24);
        if ($days_overdue > 0) {
            $total_fine += floor($days_overdue) * $rate_per_day;
        }
    }

    return $total_fine;
} */

function getUserLoans($conn, $user_id) {
    $loans = [];
    $fine_per_day = 20;

    $sql = "SELECT * FROM loans WHERE user_id = '$user_id' ORDER BY borrow_date DESC";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $fine = 0;
            if ($row['status'] === 'Returned' && !empty($row['actual_return'])) {
                $due = strtotime($row['return_date']);
                $actual = strtotime($row['actual_return']);
                $grace_period = 2 * 86400;

                if ($actual > $due + $grace_period) {
                    $late_days = floor(($actual - $due - $grace_period) / 86400);
                    $fine = $late_days * $fine_per_day;
                }
            }
            $row['fine_amount'] = $fine;
            $loans[] = $row;
        }
    }

    return $loans;
}


function calculateTotalFineByUserId($conn, $user_id) {
    $fine_per_day = 20;
    $total_fine = 0;

    $sql = "SELECT return_date, actual_return 
            FROM loans 
            WHERE user_id = '$user_id' AND status = 'Returned'";

    $result = mysqli_query($conn, $sql);
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $due = strtotime($row['return_date']);
            $actual = strtotime($row['actual_return']);

            // Only calculate if returned late (after 2-day grace)
            if ($actual > $due + 2 * 86400) {
                $late_days = floor(($actual - $due - 2 * 86400) / 86400);
                $total_fine += $late_days * $fine_per_day;
            }
        }
    }

    return $total_fine;
}


?>