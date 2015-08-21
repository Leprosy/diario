<?php 
namespace Lib;

class Db {
    static function get() {
        $dsn = "mysql:dbname=diario;host=localhost";
        $username = "root";
        $password = "leprosy";
        $pdo = new \PDO($dsn, $username, $password);
        $pdo->exec("set names utf8");
        $db = new \NotORM($pdo);
        //$db->debug = function($q, $p) { var_dump($q); var_dump($p); };
        return $db;
    }
}