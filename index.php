<?php
session_start();
if (!isset($_SESSION['logged']) || ($_SESSION['logged'] == !true)) {
    header('Location:main.php');
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>to do list</title>
    <link href="index.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display&display=swap" rel="stylesheet">
</head>

<body>
    <?php
    echo date('H:i:s');
    echo ('<br>')
    ?>
    <a href="logout.php">wyloguj</a>
    <section class="inputs">
        <label><input type="text" class="new_task" placeholder="Dodaj zadanie">
            <button class="button_new">Dodaj</button>
        </label><br>
        <label><input type="text" class="search_task" placeholder="Wyszukaj zadanie">


    </section>
    <section class="tasks">
        <div class="tasks_to_do">
            <div>do zrobienia</div>
            <form method="post">
                <fieldset id="field">



                </fieldset>
            </form>
        </div>
        <div class="tasks_done">
            <div>zrobione</div>
            <fieldset id="field_done">

            </fieldset>
        </div>
    </section>
    <script src="Task.js"></script>
    <script src="Tasks.js"></script>
    <script src="main.js"></script>
</body>

</html>