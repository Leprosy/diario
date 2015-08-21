<?php 
function title($post, $featured = false) {
    if ($featured) {
        $tag = "h1";
    } else {
        $tag = "h2";
    }

    return '<' . $tag . '><a href="'. $post["url"] .'">' . $post["title"] . '</a></' . $tag .'>';
}
?>

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
                        <?php $feat = true; foreach ($featuredPosts as $post) : ?>
                            <?php include("featuredpost.php"); ?>
                        <?php $feat = false; endforeach; ?>
                        </div>

                        <!-- Noticias -->
                        <div class="pure-g" id="news">
                            <?php foreach ($posts as $post) : ?>
                            <?php include("post.php"); ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>