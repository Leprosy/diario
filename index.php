<?php
include 'lib/Config.php';

try {
    /* Is a page requested or the home page */
    $pagNum = isset($_GET['page']) ? (int)$_GET['page'] : false;

    if ($pagNum) {
        /* Page */
        if (!$page = Html::getPage($pagNum)) {
            ob_start();

            /* Get data */
            $stream = Db::getStream($pagNum);

            /* Generate markup */
            foreach ($stream as $post) {
                include('tpl/article.php');
            }

            /* Save to cache */
            $page = ob_get_clean();
            file_put_contents(Config::cacheFile . $pagNum, $page);
        }
    } else {
        /* Home */
        /* Look for cached html */
        if (!$page = Html::getPage()) {
            ob_start();

            /* Get data */
            $feat   = Db::getFeatured();
            $stream = Db::getStream();

            /* Generate markup */
            include('tpl/template.php');

            /* Save to cache */
            $page = ob_get_clean();
            file_put_contents(Config::cacheFile, $page);
        }
    }
} catch(Exception $e) {
    include('tpl/error.php');

    if (Config::environment == 'development') {
        var_dump($e);
    }
}

/* Show site */
echo $page;
