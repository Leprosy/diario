<!DOCTYPE html>
<html lang="es">
    <head>
        <title>El Diario - <?php echo date('d-m-Y') ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="initial-scale=1">
        <link rel="stylesheet" href="css/style.css">
        <link rel="icon" href="img/icon.png" type="image/x-icon" />
        <link rel="shortcut icon" href="img/icon.png" type="image/x-icon" />
        <script src="js/jquery.js"></script>
    </head>

    <body>
        <div id="page">

            <header>
                <p>El Diario - <?php echo date('d') ?> de <?php echo Html::month(date('m') * 1) ?> de <?php echo date('Y') ?></p>
            </header>

            <section id="big">
                <article class="main">
                    <h1>"Houston...¡tenemos un tremendo problema!"</h1>
                    <p>(pero nuestros ingenieros están trabajando en él ;) )</p>
                </article>
            </section>

            <footer>
                (C)<?php echo date('Y') ?> Leprosystems
            </footer>
        </div>
    </body>
</html>
