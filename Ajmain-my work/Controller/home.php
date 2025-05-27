<?php
session_start();

if (isset($_SESSION['status']) && $_SESSION['status'] === true) {
    $timeout_duration = 300; // 5 minutes

    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $timeout_duration) {
        session_destroy();
        header("Location: login.php?timeout=true");
        exit();
    }

    $_SESSION['last_activity'] = time();
    echo "<h1>Welcome, " . $_SESSION['username'] . "!</h1>";
    echo "<a href='logout.php'>Logout</a>";
} else {
    header('Location: ../View/login.php');
    exit();
}
?>
