<?php

session_start();
$file = 'notes.txt';

////////// Авторизация и запись имени в сессию /////////////////////

if (isset($_POST['logout'])) {
    unset($_SESSION['name']);

    header('Location: index.php');
    die;
}


if (!empty($_POST['name'])) {
    $_SESSION['name'] = $_POST['name'];
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

/// Основная логика записи в файл и чтения данных заметки из файла //////////


?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Мои заметки</title>
    <link rel = "stylesheet" href="css/style.css">


</head>

<body>

<header class="topbar">
    <div class="brand">NOTES / PHP</div>
    <div class="status">Created for practice</div>
</header>

<div class="page">

    <aside class="sidebar">

        <div class="eyebrow">Account</div>

        <div class="panel">

            <?php if (!isset($_SESSION['name'])): ?>

                <form action="" method="post">
                    <input
                            type="text"
                            name="name"
                            placeholder="Введите имя"
                    >

                    <button type="submit">
                        Войти
                    </button>
                </form>

            <?php else: ?>

                <div>
                    Привет, <?= htmlspecialchars($_SESSION['name']) ?>
                </div>

                <form action="" method="post">
                    <button
                            type="submit"
                            name="logout"
                            class="logout"
                    >
                        Выйти
                    </button>
                </form>

            <?php endif; ?>

        </div>

        <div class="eyebrow">New entry</div>

        <form action="" method="post">
            <textarea
                    name="note"
                    placeholder="Введите заметку"></textarea>

            <button type="submit">
                Добавить заметку
            </button>
        </form>

    </aside>

    <main class="content">

        <div class="eyebrow">
            Personal archive
        </div>

        <h1>Мои<br>заметки</h1>

        <div class="notes-header">
            <h2>Entries</h2>
            <span>Archive</span>
        </div>

        <div class="note-placeholder">
            <?php
            if (isset($_SESSION['name'])) {
                $hasNotes = false;

                foreach ($notes as $note) {
                    $data = explode('--##--', $note);

                    if ($data[0] == $_SESSION['name']) {
                        $hasNotes = true;

                        echo "<pre>";
                        echo "Автор: " . htmlspecialchars($data[0]) . PHP_EOL;
                        echo "Заметка: " . htmlspecialchars($data[1]);
                        echo "</pre>";
                    }
                }

                if (!$hasNotes) {
                    echo "У вас пока нет заметок";
                }
            }

            ?>
        </div>

    </main>

</div>

</body>
</html>