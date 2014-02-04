<?php
include 'lib/Config.php';

try {
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
} catch(Exception $e) {
    include('error.php');

    if (Config::environment == 'development') {
        var_dump($e);
    }
}

/* Show site */
echo $page;
