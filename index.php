<?php

session_start();
$file = 'notes.txt';

////////// Авторизация и запись имени в сессию /////////////////////

if (isset($_POST['logout'])) {
    unset($_SESSION['name']);
}

if (!empty($_POST['name'])) {
    $_SESSION['name'] = $_POST['name'];
}

if (isset($_SESSION['name'])) {
    echo "Привет, " . htmlspecialchars($_SESSION['name']);
}

////////// Авторизация и запись имени в сессию /////////////////////
///
///
///
///
///
///  Основная логика ввода заметки с учётом сессии и заполненного поля note //////////

if (isset ($_SESSION ['name']) && (!empty($_POST['note']))) {
    $result = $_SESSION['name'] . '--##--' . $_POST['note'];
    file_put_contents($file, $result . PHP_EOL, FILE_APPEND);
    header('Location: index.php');
    die;

}

///  Основная логика ввода заметки с учётом сессии и заполненного поля note //////////
///
///
///
/// Основная логика записи в файл и чтения данных заметки из файла //////////
if (file_exists ($file)) {
    $notes = file ($file);
} else {
    $notes = [];
}
foreach ($notes as $note) {
    $data = explode('--##--', $note);
    echo "<pre>";
    //var_dump($note);
    var_dump($data);
    echo "</pre>";
}

/// Основная логика записи в файл и чтения данных заметки из файла //////////


?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Мои заметки</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f4f1;
            color: #111;
        }

        .container {
            width: min(720px, calc(100% - 40px));
            margin: 0 auto;
            padding: 70px 0;
        }

        h1 {
            margin: 0 0 50px;
            font-size: 42px;
            font-weight: 500;
            letter-spacing: -1.5px;
        }

        form {
            margin-bottom: 28px;
            padding-bottom: 28px;
            border-bottom: 1px solid #d5d5d0;
        }

        input,
        textarea {
            width: 100%;
            margin-bottom: 12px;
            padding: 16px 0;
            border: 0;
            border-bottom: 1px solid #999;
            border-radius: 0;
            outline: none;
            background: transparent;
            color: #111;
            font: inherit;
        }

        textarea {
            min-height: 130px;
            resize: vertical;
        }

        input::placeholder,
        textarea::placeholder {
            color: #777;
        }

        input:focus,
        textarea:focus {
            border-bottom-color: #111;
        }

        button {
            padding: 13px 22px;
            border: 1px solid #111;
            border-radius: 0;
            background: #111;
            color: #fff;
            font: inherit;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 1px;
            cursor: pointer;
            transition: 0.2s;
        }

        button:hover {
            background: transparent;
            color: #111;
        }

        form:nth-of-type(2) button {
            background: transparent;
            color: #111;
        }

        form:nth-of-type(2) button:hover {
            background: #111;
            color: #fff;
        }

        @media (max-width: 600px) {
            .container {
                padding: 40px 0;
            }

            h1 {
                font-size: 34px;
                margin-bottom: 35px;
            }
        }
    </style>
</head>

<body>

<main class="container">

    <h1>Мои заметки</h1>

    <form action="" method="post">
        <input type="text" name="name" placeholder="Введите имя">
        <button type="submit">Войти</button>
    </form>

    <form action="" method="post">
        <button type="submit" name="logout">Выйти</button>
    </form>

    <form action="" method="post">
        <textarea name="note" placeholder="Введите заметку"></textarea>
        <button type="submit">Добавить заметку</button>
    </form>

</main>

</body>
</html>