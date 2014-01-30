<?php
include 'lib/Config.php';

/* Look for cached html */
if (!$page = Html::getPage()) {
    ob_start();

    /* Get data */
    $feat   = Db::getFeatured();
    $stream = Db::getStream();

    /* Generate markup */
    include('template.php');

    /* Save to cache */
    $page = ob_get_clean();
    file_put_contents(Config::cacheFile, $page);
} else {
    echo "cache hit";
}

/* Show site */
echo $page;
