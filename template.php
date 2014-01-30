<!DOCTYPE html>
<html lang="es">
    <head>
        <title>El diario - <?php echo date('d-m-Y') ?></title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/style.css">
    </head>

    <body>
        <div id="page">

            <header>
                <p>El diario - <?php echo date('d-m-Y') ?></p>
            </header>

            <section id="big">
                <article class="main">
                    <h1><?php echo $feat[0]->title ?></h1>
                    <p class="meta">Publicado hace <?php echo Html::relativeDate($feat[0]->date) ?> vía <?php echo $feat[0]->source ?></p>
                    <p><?php echo $feat[0]->content ?></p>
                </article>

                <?php for ($i = 1; $i < 4; ++$i) : ?>
                <article class="sub">
                    <h1><?php echo $feat[$i]->title ?></h1>
                    <p class="meta">Publicado hace <?php echo Html::relativeDate($feat[$i]->date) ?> vía <?php echo $feat[$i]->source ?></p>
                    <p><?php echo $feat[$i]->content ?></p>
                </article>
                <?php endfor; ?>
            </section>

            <section id="body">
                <?php foreach($stream as $post) : ?>
                <article class="sub">
                    <h1><?php echo $post->title ?></h1>
                    <p class="meta">Publicado hace <?php echo Html::relativeDate($post->date) ?> vía <?php echo $post->source ?></p>
                    <p><?php echo $post->content ?></p>
                </article>
                <?php endforeach; ?>
            </section>

            <footer>
                (C)<?php echo date('Y') ?> Leprosystems
            </footer>
        </div>
    </body>
</html>
