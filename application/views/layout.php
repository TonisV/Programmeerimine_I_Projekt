<?php require_once('application/views/header.php'); ?>

    <header>
        <div class="logo"></div>
        <nav class="main-nav">
            <a class="main-nav__item" href="">Tööleht</a>
            <a class="main-nav__item" href="">Seaded</a>
        </nav>
        <nav class="side-nav">
            <a class="side-nav__item" href="">Kasutaja</a>
        </nav>
    </header>

    <main><?php require_once('application/lib/routes.php'); ?></main>
<?php require_once('application/views/footer.php'); ?>