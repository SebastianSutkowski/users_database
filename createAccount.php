<?php
session_start();
if (isset($_POST['login'])) {

    $eok = true;
    $login = $_POST['login'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    $pass_hash = password_hash($password, PASSWORD_DEFAULT);
    $mail = $_POST['mail'];
    // sprawdzam login i mail;
    require_once "connect.php";
    try {
        if (strlen($login) < 4 || strlen($login > 20)) {
            $eok = false;
            $_SESSION['nick_l'] = "nick musi mieć więcej niż 4 i mniej niż 20 znaków";
        }
        $login_db = $conn->query("SELECT id FROM users WHERE login='$login'");
        if (!$login_db) {
            throw new Exception($login_db->error);                   // jak bedzie false zwroci kod bledu
        }
        if ($login_db->num_rows > 0) {
            $eok = false;
            $_SESSION['nick_l'] = "juz istnieje taki nick";
        }

        // sprawdzamy maila
        $emailGood = filter_var($mail, FILTER_SANITIZE_EMAIL);
        if ((filter_var($emailGood, FILTER_VALIDATE_EMAIL) == false) || $mail = !$emailGood) {
            $eok = false;
            $_SESSION['mail_p'] = "niepoprawny mail";
        }

        //SPRAWDZAM HASŁA
        if ($password = !$password2 || strlen($password) < 4 || strlen($password > 20)) {
            $_SESSION['password_p'] = "hasło musi mieć więcej niż 4 i mniej niż 20 znaków";
            $eok = false;
        }
        //sprawdzam ferulamin
        if (!isset($_POST['accept'])) {
            $_SESSION['reg_p'] = "musisz zaakceptować regulamin";
            $eok = false;
        }
        // SPRAWDZAM BOTA
        $skey = "6LfkmNgUAAAAAJNLw_B3BqODPqfqonMfIFneY940";
        $checkkey = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $skey . '&response=' . $_POST['g-recaptcha-response']);
        $answer = json_decode($checkkey);
        if ($answer->success == false) {
            $_SESSION['cap_p'] = "udowodnij, że jesteś człowiekiem";
            $eok = false;
        }
        if ($eok == true) {
            if ($conn->query("INSERT INTO users VALUES(NULL, '$login', '$pass_hash','[]','[]')")) {
                header('Location:main.php');
            } else {
            }
        }
        $conn->close();
    } catch (Exception $e) {
        echo 'Connection failed: ' . $e->getMessage();
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>rejestracja</title>
    <link href="main.css" rel="stylesheet" type="text/css" />
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>
    <form method="post">
        <a>podaj login</a>
        <label><input type="text" class="login" placeholder="Podaj login" name="login"></label><br>
        <?php
        if (isset($_SESSION['nick_l'])) {
            echo $_SESSION['nick_l'] . "<br>";
            unset($_SESSION['nick_l']);
        }

        ?>
        <a>podaj hasło</a>
        <label><input type="password" class="password" name="password"></label><br>
        <a>powtórz hasło</a>
        <label><input type="password" class="password" name="password2"></label><br>
        <?php
        if (isset($_SESSION['password_p'])) {
            echo $_SESSION['password_p'] . "<br>";
            unset($_SESSION['password_p']);
        }
        ?>
        <a>podaj maila</a>
        <label><input type="text" name="mail"><br></label>
        <?php
        if (isset($_SESSION['mail_p'])) {
            echo $_SESSION['mail_p'] . "<br>";
            unset($_SESSION['mail_p']);
        }

        ?>
        <label><input type="checkbox" name="accept"><a>Akceptuję regulamin</a></label><br></label>
        <?php
        if (isset($_SESSION['reg_p'])) {
            echo $_SESSION['reg_p'] . "<br>";
            unset($_SESSION['reg_p']);
        }

        ?>
        <div class="g-recaptcha" data-sitekey="6LfkmNgUAAAAANuXNPrWLtd3Umyq18lxKaxe4-v3"></div>
        <?php
        if (isset($_SESSION['cap_p'])) {
            echo $_SESSION['cap_p'] . "<br>";
            unset($_SESSION['cap_p']);
        }

        ?>
        <button class="button_new">zarejestruj</button>

        <br />
    </form>

</body>

</html>