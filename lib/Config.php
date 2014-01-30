<?php

/* Basic configuration */
class Config {
    /* Db connection */
    const host  = 'localhost';
    const db    = 'diario';
    const user  = 'root';
    const pass  = 'leprosy';

    /* Content */
    const pageSize    = 20;
    const twSize      = 1;
    const fbSize      = 1;
    const socialFeat  = 40;
    const socialSFeat = 60;
    
    /* cache */
    const cacheFile = 'cache/site.html';
    const cacheTime = 1; //1 min

    /* Builder */
    const buildFile = 'cache/build.html';
    const buildTime = 1; //15 mins
}

/* Autoloading */
function _diarioAutoLoad($classname) {
    $classpath = "lib/$classname.php";

    if (file_exists($classpath)) {
        require($classpath);
    }
}
spl_autoload_register('_diarioAutoLoad');