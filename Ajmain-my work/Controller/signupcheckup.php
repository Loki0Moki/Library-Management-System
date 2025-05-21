<?php
if (isset($_POST['submit'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $confirm = trim($_POST['confirm_password']);

    if ($username === "" || $password === "" || $confirm === "") {
        echo "All fields are required!";
    } elseif ($password !== $confirm) {
        echo "Passwords do not match!";
    } else {
        $data = file_get_contents('users.txt');
        if (strpos($data, $username . "|") !== false) {
            echo "Username already exists!";
        } else {
            $file = fopen('users.txt', 'a');
            fwrite($file, $username . "|" . $password . "\n");
            fclose($file);
            echo "Signup successful! <a href='../View/login.html'>Login now</a>";
        }
    }
} else {
    header('Location: ../View/signup.html');
    exit();
}
?>
