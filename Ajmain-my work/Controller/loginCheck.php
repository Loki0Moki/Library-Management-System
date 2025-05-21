<?php
session_start();
if (isset($_POST['submit'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $remember = isset($_POST['remember']);

    if ($username === "" || $password === "") {
        echo "Username or password cannot be empty!";
    } else {
        $users = file('users.txt', FILE_IGNORE_NEW_LINES);
        $valid = false;
        foreach ($users as $user) {
            list($u, $p) = explode('|', $user);
            if ($u === $username && $p === $password) {
                $valid = true;
                break;
            }
        }

        if ($valid) {
            $_SESSION['status'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['last_activity'] = time();

            if ($remember) {
                setcookie('username', $username, time() + 3600 * 24 * 7); 
                setcookie('password', $password, time() + 3600 * 24 * 7);
            }

            header('location: home.php');
        } else {
            echo "Invalid credentials!";
        }
    }
} else {
    header('Location: ../View/login.html');
    exit();
}
?>
