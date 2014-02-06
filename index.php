<?php
include 'lib/Config.php';

try {
    $pagNum = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $search = isset($_GET['search']) ? $_GET['search'] : '';
    $file = sprintf("%s_%s_%d", Config::cacheFile, $search, $pagNum);

    /* Is a page requested or the home page */
    if ($pagNum > 1) {
        /* Page */
        if (!$page = Html::getPage($file)) {
            ob_start();

            /* Get data */
            $stream = Db::getStream($search, $pagNum);

            /* Generate markup */
            foreach ($stream as $post) {
                include('tpl/article.php');
            }

            /* Save to cache */
            $page = ob_get_clean();
            file_put_contents($file, $page);
        }
    } else {
        /* Home */
        /* Look for cached html */
        if (!$page = Html::getPage($file)) {
            ob_start();

            /* Get data */
            $feat   = Db::getFeatured($search);
            $stream = Db::getStream($search, $pagNum);

            /* Generate markup */
            include('tpl/template.php');

            /* Save to cache */
            $page = ob_get_clean();
            file_put_contents($file, $page);
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
