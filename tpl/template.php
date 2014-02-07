<!DOCTYPE html>
<html lang="es">
    <head>
        <title>El Diario - <?php echo date('d-m-Y') ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="initial-scale=1">
        <meta name="description" content="Noticias de varios medios en español, compiladas y ordenadas para ud." />
        <link rel="stylesheet" href="css/style.css">
        <link rel="icon" href="img/icon.png" type="image/x-icon" />
        <link rel="shortcut icon" href="img/icon.png" type="image/x-icon" />
        <script src="js/jquery.js"></script>
        <?php include('track.php') ?>
    </head>

    <body>
        <div id="page">

            <header>
                <p><a href="http://diario.l3pro.com/">El Diario</a> - <?php echo date('d') ?> de <?php echo Html::month(date('m') * 1) ?></p>
                <div class="search">
                    <input id="search" type="text" autocomplete="off" placeholder="Buscar..." value="<?php echo $search ?>" />
                </div>
            </header>

            <?php if (count($feat)) : ?>
            <section id="big">
                <article class="main">
                    <h1><a href="<?php echo $feat[0]->link ?>" target="_blank"><?php echo $feat[0]->title ?></a></h1>
                    <p class="meta">Publicado <?php echo Html::relativeDate($feat[0]->date) ?> vía <b><?php echo $feat[0]->source ?></b></p>
                    <p>
                        <?php if ($feat[0]->thumb) : ?>
                            <img src="<?php echo $feat[0]->thumb ?>" />
                        <?php endif; ?>
                        <?php echo $feat[0]->content ?> ... <a class="more" href="<?php echo $feat[0]->link ?>" target="_blank">[Leer más]</a>
                    </p>
                </article>

                <?php for ($i = 1; $i < count($feat); ++$i) : ?>
                <article class="sub">
                    <h1><a href="<?php echo $feat[$i]->link ?>" target="_blank"><?php echo $feat[$i]->title ?></a></h1>
                    <p class="meta">Publicado <?php echo Html::relativeDate($feat[$i]->date) ?> vía <b><?php echo $feat[$i]->source ?></b></p>
                    <p>
                        <?php if ($feat[$i]->thumb) : ?>
                            <img src="<?php echo $feat[$i]->thumb ?>" />
                        <?php endif; ?>
                        <?php echo $feat[$i]->content ?> ... <a class="more" href="<?php echo $feat[$i]->link ?>" target="_blank">[Leer más]</a>
                    </p>
                </article>
                <?php endfor; ?>

                <?php include('tpl/ad.php') ?>
            </section>
            <?php endif; ?>

            <section id="normal">
            <?php if (count($stream)) : ?>
                <?php foreach($stream as $post) : ?>
                <?php include('tpl/article.php') ?>
                <?php endforeach; ?>

                <?php include('tpl/ad.php') ?>
            <?php else: ?>
                <h2>No se encontraron noticias...</h2>
            <?php endif; ?>
            </section>

            <!-- <footer>
                (C)<?php echo date('Y') ?> Leprosystems
            </footer> -->
        </div>

        <div id="infobox">Trayendo más noticias...</div>

        <script>
            var page = 1;

            $(function () {
                // Infinite scroll
                var $win = $(window);

                $win.scroll(function () {
                    if ($win.height() + $win.scrollTop() == $(document).height()) {
                        $('#infobox').fadeIn();

                        $.get('index.php?<?php if ($search) : ?>search=<?php echo $search ?>&<?php endif; ?>page=' + (++page), function (data){
                            $data = $(data);
                            $('#normal').append($data);
                            $('#infobox').fadeOut();
                        })
                    }
                });

                // Search
                var goSearch = function() {
                    window.location = '?search=' + $('#search').val();
                }

                $('#search').on('keydown', function(e) {
                    if (e.keyCode == 13) {
                        goSearch();
                    }
                })
            });
        </script>
    </body>
</html>
