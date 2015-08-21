<?php 
namespace Lib;

class Utils {
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
}