<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css" />
        <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/grids-responsive-min.css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" />
        <link rel="stylesheet" href="css/style.css" />
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>El Diario - <?php echo $date ?></title>
    </head>

    <body>
        <div class="pure-g">
            <div class="pure-u-1 pure-u-lg-11-12" id="page">
                <div class="pure-g">
                    <div class="pure-u-1 pure-u-md-1-4" id="title">
                        <h1>El Diario</h1>
                    </div>

                    <div class="pure-u-1 pure-u-md-3-4" id="content">
                        <!-- Titulares -->
                        <div class="pure-g" id="headers">
                            <div class="pure-u-1" id="main-header">
                                <div class="post">
                                    <h1><?php echo $posts[0]["title"] ?></h1>
                                    <p class="meta">Hace 2 días vía <a href="#"><?php echo $posts[0]["source"] ?></a></p>
                                    <img src="<?php echo $posts[0]["image"] ?>" class="pure-img" />
                                    <p><?php echo $posts[0]["text"]?></p>
                                </div>
                            </div>

                            <?php for ($i = 1; $i < 4; ++$i) : ?>
                            <div class="pure-u-1 pure-u-md-1-3" id="secondary-headers">
                                <div class="post">
                                    <h2><?php echo $posts[$i]["title"] ?></h2>
                                    <p class="meta">Hace 2 días vía <a href="#"><?php echo $posts[$i]["source"] ?></a></p>
                                    <img src="<?php echo $posts[$i]["image"] ?>" class="pure-img" />
                                    <p><?php echo $posts[$i]["text"] ?></p>
                                </div>
                            </div>
                            <?php endfor; ?>
                        </div>

                        <!-- Titulares -->
                        <div class="pure-g" id="news">
                            <?php for ($i = 4; $i < 10; ++$i) : ?>
                            <?php if ($i == 4 || $i == 6) : ?>
                            <div class="pure-u-1 pure-u-md-1-4">
                                <div class="post featured">
                                    <h3><?php echo $posts[$i]["title"] ?></h3>
                                    <p class="meta">Hace 2 días vía <a href="#"><?php echo $posts[$i]["source"] ?></a></p>
                                    <img src="<?php echo $posts[$i]["image"] ?>" class="pure-img" />
                                    <p><?php echo $posts[$i]["text"] ?></p>
                                </div>
                            </div>
                            <?php else: ?>
                            <div class="pure-u-1 pure-u-md-1-4">
                                <div class="post">
                                    <h4><?php echo $posts[$i]["title"] ?></h4>
                                    <p class="meta">Hace 2 días vía <a href="#"><?php echo $posts[$i]["source"] ?></a></p>
                                    <p><?php echo $posts[$i]["text"] ?></p>
                                </div>
                            </div>
                            <?php endif; ?>
                            <?php endfor; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>