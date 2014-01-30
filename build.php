<?php
include('lib/Config.php');

if (file_exists(Config::buildFile) 
                && ((time() - filemtime(Config::buildFile)) < Config::buildTime )) {
    echo "\n\nD'oh!";
} else {
    Builder::build();
    file_put_contents(Config::buildFile, "ok");
    echo "\n\nBuild ok!";
    die();
}