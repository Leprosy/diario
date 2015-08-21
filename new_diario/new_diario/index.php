<?php
require 'vendor/autoload.php';

$app = new \Slim\Slim();

//Home
$app->get("/", function() use ($app) {
    $timeLimit = 43200; // 30mins
    $ids = array();
    $db = \Lib\Db::get();

    // Featured
    $featuredPosts = $db->post()
                        ->where("UNIX_TIMESTAMP() - published < ?", $timeLimit)
                        ->order("(fb + tw) DESC")
                        ->limit(4);

    foreach ($featuredPosts as $post) {
        $ids[] = $post["id"];
    }

    // The remaining info
    $posts = $db->post()
                ->where("id NOT IN (?)", implode($ids, ","))
                ->order("published DESC")
                ->limit(20);

    $app->render("home.php", array(
            "date" => date("j/n/Y"),
            "posts" => $posts,
            "featuredPosts" => $featuredPosts
    ));
});

//Scrapper
$app->get("/update", function() use ($app) {
    $db = \Lib\Db::get();
    $sources = array("elmostrador", "latercera", "emol", "el_dinamo"); //"theclinic", "quintopoder", "definido";
    $tw = new \Lib\Extractor();

    foreach ($sources as $source) {
        $posts = $tw->getPosts($source);
        $sc = new \Lib\Scraper($source);

        foreach ($posts as $post) {
            $dat = $sc->extract($post);

            if ($dat != null) {
                var_dump($dat["url"]);
                //Check if url exists
                $urls = $db->post()->where("url LIKE ?", $dat["url"]);

                if (count($urls) == 0) {
                    var_dump("inserting");
                    $db->post->insert($dat);
                } else {
                    var_dump("updating");
                    $post = $urls->fetch();
                    $post["fb"] =  \Lib\Scraper::getFB($dat["url"]);
                    $post["tw"] =  \Lib\Scraper::getTW($dat["url"]);
                    $post->update();
                }
            }
        }
    }
});

$app->run();
