<?php

require 'vendor/autoload.php';

/*$dsn = "mysql:dbname=slimtut;host=localhost";
$username = "dbuser";
$password = "dbpass";
$pdo = new PDO($dsn, $username, $password);
$db = new NotORM($pdo); */
$app = new \Slim\Slim();

//Home
$app->get("/", function() use ($app) {
    $app->render("home.php", array(
            "date" => date("j/n/Y")
    ));
});

//Scrapper
$app->get("/update", function() use ($app) {
    $data = [];
    $sources = array("elmostrador", "latercera", "emol", "el_dinamo"); //"theclinic", "quintopoder", "definido";
    $tw = new \Lib\Extractor();

    foreach ($sources as $source) {
        $posts = $tw->getPosts($source, 3);
        $sc = new \Lib\Scraper($source);

        foreach ($posts as $post) {
            $dat = $sc->extract($post);

            if ($dat != null) {
                $data[] = $dat; 
            }
        }
    }

    $app->render("home.php", array(
            "date" => date("j/n/Y"),
            "posts" => $data
    ));
});

$app->run();
