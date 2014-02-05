<?php

class Db {
    static private $instance = false;

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new PDO(sprintf("mysql:host=%s;dbname=%s", Config::host, Config::db), Config::user, Config::pass);
            self::$instance->query('SET NAMES utf8');
        }

        return (self::$instance);
    }

    public static function getFeatured($onlyIds = false) {
        $Db  = self::getInstance();
        $sql = sprintf("SELECT * FROM post WHERE date >= %d ORDER BY social DESC LIMIT 4", (time() - 3600));
        $featured = $Db->query($sql)->fetchAll(PDO::FETCH_OBJ);
        $ids = array();

        foreach ($featured as $post) {
            $ids[] = $post->id;
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
        $sql       = sprintf("SELECT * FROM post $condition ORDER BY date DESC LIMIT %d, %d",(Config::pageSize * ($page - 1)), Config::pageSize);
        $posts     = $Db->query($sql);

        if ($posts) {
            return $posts->fetchAll(PDO::FETCH_OBJ);
        } else {
            return array();
        }
    }

    public static function savePost($post) {
        $Db  = self::getInstance();        
        $sql = sprintf("SELECT id FROM post WHERE link = '%s'", $post->link);
        $res = $Db->query($sql);

        if ($res->rowCount() > 0) {
            /* update social status */
            $res = $res->fetchAll(PDO::FETCH_OBJ);
            $sql = sprintf("UPDATE post SET social = %s WHERE id = %s", $post->social, $res[0]->id);
            return $Db->exec($sql) . ' updated';
        } else {
            /* insert post */
            $sql = sprintf("INSERT INTO post (title, link, source, social, content, thumb, date) VALUES ('%s','%s','%s',%s,'%s','%s',%s)", $post->title, $post->link, $post->source, $post->social, $post->content, $post->thumb, $post->date);
            return $Db->exec($sql) . ' saved';
        }
    }
}
