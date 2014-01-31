<!DOCTYPE html>
<html lang="es">
    <head>
        <title>El Diario - <?php echo date('d-m-Y') ?></title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/style.css">
        <script src="js/jquery.js"></script>
    </head>

    <body>
        <div id="page">

            <header>
                <p>El Diario - <?php echo date('d') ?> de <?php echo Html::month(date('m') * 1) ?> de <?php echo date('Y') ?></p>
            </header>

            <section id="big">
                <article class="main">
                    <h1><a href="<?php echo $feat[0]->link ?>" target="_blank"><?php echo $feat[0]->title ?></a></h1>
                    <p class="meta">Publicado hace <?php echo Html::relativeDate($feat[0]->date) ?> vía <?php echo $feat[0]->source ?></p>
                    <p><?php echo $feat[0]->content ?> ... <a class="more" href="<?php echo $feat[0]->link ?>" target="_blank">[Leer más]</a></p>
                </article>

                <?php for ($i = 1; $i < 4; ++$i) : ?>
                <article class="sub">
                    <h1><a href="<?php echo $feat[$i]->link ?>" target="_blank"><?php echo $feat[$i]->title ?></a></h1>
                    <p class="meta">Publicado hace <?php echo Html::relativeDate($feat[$i]->date) ?> vía <?php echo $feat[$i]->source ?></p>
                    <p><?php echo $feat[$i]->content ?> ... <a class="more" href="<?php echo $feat[$i]->link ?>" target="_blank">[Leer más]</a></p>
                </article>
                <?php endfor; ?>
            </section>

            <section id="normal">
                <?php foreach($stream as $post) : ?>
                <article class="sub">
                    <h1><a href="<?php echo $post->link ?>" target="_blank"><?php echo $post->title ?></a></h1>
                    <p class="meta">Publicado hace <?php echo Html::relativeDate($post->date) ?> vía <?php echo $post->source ?></p>
                    <p><?php echo $post->content ?> ... <a class="more" href="<?php echo $post->link ?>" target="_blank">[Leer más]</a></p>
                </article>
                <?php endforeach; ?>
            </section>

            <footer>
                (C)<?php echo date('Y') ?> Leprosystems
            </footer>
        </div>

        <div id="infobox">Trayendo más noticias...</div>

        <script>
            $(function () {
                var $win = $(window);

                $win.scroll(function () {
                    if ($win.height() + $win.scrollTop() == $(document).height()) {
                        $('#infobox').fadeIn();

                        $.get('page.php?page=' + (++page), function (data){
                            $data = $(data);
                            $('#stream').append($data).masonry('appended', $data, true);
                            $('#infobox').fadeOut();
                        })
                    }
                });
            });
        </script>
    </body>
</html>
