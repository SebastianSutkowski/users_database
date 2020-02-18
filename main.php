<?php
session_start();
if (isset($_SESSION['logged']) && ($_SESSION['logged'] == true)) {
    header('Location:index.php');
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="main.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <form action="checkLog.php" method="post">
        <label><input type="text" class="login" placeholder="Podaj login" name="login"><br>
            <label><input type="password" class="password" placeholder="Podaj hasło" name="password"><br>
                <button class="button_new">zaloguj</button>
            </label><br>
    </form>


    <?php
    if (isset($_SESSION['blad']))
        echo $_SESSION['blad'];
    unset($_SESSION['blad'])
    ?>
    <form action="createAccount.php">
        <button type="submit">załóż nowe konto</button>
    </form>
</body>

</html>