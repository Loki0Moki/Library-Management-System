<?php
session_start();
require_once '../Model/db_connect.php'; 

if (isset($_POST['submit'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $remember = isset($_POST['remember']);

    if ($username === "" || $password === "") {
        
        header('Location: ../View/login.php');
        exit();
    }

    
    if (validateUser($username, $password)) {
        $_SESSION['status'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['last_activity'] = time();

        if ($remember) {
            
            setcookie('username', $username, time() + 3600 * 24 * 7, "/");
            
        }

        header('Location: ../View/home-dashboard.php');
        exit();
    } else {
        
        header('Location: ../View/login.php');
        exit();
    }
} else {
    header('Location: ../View/login.php');
    exit();
}
?>
