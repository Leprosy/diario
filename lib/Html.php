<?php

class Html {
    static private $articleTpl = false;

    static public function getPage($file) {
        if (file_exists($file) && ((time() - filemtime($file)) < Config::cacheTime )) {
            return file_get_contents($file);
        } else {
            return false;
        }
    }

    static function relativeDate($d) {
        if (!is_numeric($d)) {
            $etime = time() - strtotime($d);
        } else {
            $etime = time() - $d;
        }

        if ($etime < 60) {
            $resp = array(('ahora mismo'), ('recién'), ('hace instantes'), ('hace menos de un minuto'));
            return $resp[rand(0, 3)];
        }

        $a = array(
            12 * 30 * 24 * 60 * 60 => ('año'),
            30 * 24 * 60 * 60 => ('mes'),
            24 * 60 * 60 => ('día'),
            60 * 60 => ('hora'),
            60 => ('minuto'),
        );

        foreach ($a as $secs => $str) {
            $d = $etime / $secs;
            if ($d >= 1) {
                $r = round($d);
                return ( 'hace' . ' ' . $r . ' ' . $str . ($r > 1 ? ($str == 'mes' ? 'es' : 's') : '') );
            }
        }
    }

    static function month($m) {
        $mes = array('Fuck', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
        return $mes[$m];
    }

    static function words($string, $word_limit) {
        $words = explode(" ", $string);
        return implode(" ", array_splice($words, 0, $word_limit));
    }
}
