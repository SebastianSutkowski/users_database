<?php
session_start();
require_once "connect.php";
try {

    $login = $_POST['login'];
    $password = $_POST['password'];
    $loginn = htmlentities($login, ENT_QUOTES, "UTF-8");
    if ($user = $conn->query(sprintf(
        "SELECT * FROM users WHERE login='%s'",
        mysqli_real_escape_string($conn, $loginn),
    ))) {
        if ($user->num_rows == 1) {

            $row = $user->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                $_SESSION['logged'] = true;
                $_SESSION['id'] = $row['id'];
                $_SESSION['name'] = $row['login'];
                unset($_SESSION['blad']);
                header('Location:index.php');
                $user->close();
            } else {
                echo "złe hasło";
                $_SESSION['blad'] = 'złe hasło';
                $_SESSION['blad'];
                unset($_SESSION['logged']);
                header('Location:main.php');
            }
        } else {
            echo "nie ma takiego konta";
            $_SESSION['blad'] = 'nie ma takiego konta';
            $_SESSION['blad'];
            unset($_SESSION['logged']);
            header('Location:main.php');
        }
    }


    $conn->close();
} catch (Exception $e) {
    echo 'Connection failed: ' . $e->getMessage();
    exit;
}
