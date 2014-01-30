<?php

class Db {
    static private $instance = false;

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = mysql_connect(Config::host, Config::user, Config::pass);

            mysql_select_db(Config::db, self::$instance);
            mysql_query('SET NAMES utf8');
        }

        return (self::$instance);
    }

    public static function getFeatured($onlyIds = false) {
        $Db  = self::getInstance();
        $sql = "SELECT * FROM post WHERE date >= ".(time() - 43200)." ORDER BY social DESC LIMIT 4";
        $res = mysql_query($sql, $Db);

        $ids = array();
        $featured = array();

        while ($post = mysql_fetch_object($res)) {
            $ids[]      = $post->id;
            $featured[] = $post;
        }

        if ($onlyIds) {
            return $ids;
        } else {
            return $featured;
        }
    }

    public static function getStream($page = 1) {
        $Db        = self::getInstance();
        $ids       = self::getFeatured(true);
        $condition = count($ids) > 0 ? 'WHERE id NOT IN ('.implode(',', $ids).')' : '';
        $sql       = "SELECT * FROM post $condition ORDER BY date DESC LIMIT " . (Config::pageSize * ($page - 1)) . "," . Config::pageSize;
        $res       = mysql_query($sql, $Db);
        $posts     = array();

        while ($post = mysql_fetch_object($res)) {
            $posts[] = $post;
        }

        return $posts;
    }

    public static function savePost($post) {
        $Db  = self::getInstance();        
        $sql = sprintf("SELECT id FROM post WHERE link = '%s'", $post->link);
        $res = mysql_query($sql, $Db);
        var_dump($sql);

        if ($row = mysql_fetch_array($res)) {
            /* update social status */
            $sql = sprintf("UPDATE post SET social = %s WHERE id = %s", $post->social, $row[0]);
            $result = mysql_query($sql, $Db);

            return ('updated');
        } else {
            /* insert post */
            $sql = sprintf("INSERT INTO post (title, link, source, social, content, thumb, date) VALUES ('%s','%s','%s',%s,'%s','%s',%s)", $post->title, $post->link, $post->source, $post->social, Html::words(strip_tags($post->content), 150), $post->thumb, $post->date);
            $result = mysql_query($sql, $Db);

            return ('saved');
        }
    }
}