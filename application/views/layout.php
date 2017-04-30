<!DOCTYPE html>
<html lang="et">

<head>

    <meta charset="utf-8">

    <title>Projekt</title>
    <meta name="description" content="Programmeerimine I - Projekt">
    <meta name="author" content="Tõnis Vaimann">

    <!-- Normalize style -->
    <link rel="stylesheet" href="public/css/normalize.css">
    <!-- Font Awesome style -->
    <link rel="stylesheet" href="public/css/font-awesome.min.css">
    <!-- Main style -->
    <link rel="stylesheet" href="public/css/style.css">

</head>

<body>
    <div class="wrapper">
        <header>
            <div class="logo"><img src="public/images/logo.png" alt="logo"></div>

            <?php if(Session::userIsLoggedIn()) { ?>

            <nav class="main-nav">
                <ul class="menu">
                    <li class="menu__item"><a class="fa-th" href="<?= APP_URL ?>?controller=worksheet&action=index">Tööleht</a></li>
                    <li class="menu__item"><a class="fa-file-text-o" href="">Arved</a></li>
                    <li class="menu__item"><a class="fa-thumbs-up" href="">Eksperthinnang</a></li>
                    <li class="menu__item"><a class="fa-cog" href="">Seaded</a></li>
                </ul>
            </nav>
            <nav class="side-nav">
                <ul class="menu">
                    <li class="menu__item"><a class="fa-user" href="">Kasutaja</a></li>
                    <li class="menu__item"><a class="fa-sign-out" href="<?= APP_URL ?>?controller=account&action=logout">Logi välja</a></li>
                </ul>
            </nav>

            <?php } ?>

        </header>

        <main>
            <?php
                echo $appFeedback;
                require_once('application/lib/routes.php');
            ?>
        </main>

        <footer>
            <p class="copyright">TV Tööleht <span class="seperator">/</span> Autor - Tõnis Vaimann 2017 <span class="seperator">/</span> Versioon 1.0</p>
        </footer>

    </div>
<script src="public/js/jquery-3.2.1.min.js"></script>
<script src="public/js/scripts.js"></script>
</body>
</html>