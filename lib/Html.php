<?php

class Html {
    const FEAT = 50;

    static public function getPage($pag = '') {
        $file = Config::cacheFile . $pag;

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

    static function streamPost($post) {
        $date  = Html::relativeDate($post->date);
        $text  = Html::words($post->content, ($post->social > Config::socialFeat ? 70 : 40));
        $class = $post->social > Config::socialFeat ? 
                    ($post->social > Config::socialSFeat ? 'superfeatured' : 'featured') : '';
        $img   = ($post->social > Config::socialSFeat && $post->thumb!='') ? 
                    '<img src="' . $post->thumb . '" width="100" />' : '';

        $html  = <<<EOD
<article class="box $class">
    <h2><a href="$post->link" target="_blank">$post->title</a></h2>
    <p class="date">$date vía <a href="#">$post->source</a></p>
    $img
    <p>$text...</p>
    <div class="shade"></div>
    <a class="more" href="$post->link" target="_blank">Leer más</a>
</article>
EOD;
        return $html;
    }

    static function streamAd() {
        $html = <<<EOD
<article class="box ad">
    <script type="text/javascript"><!--
        google_ad_client = "ca-pub-1241131205896179";
        /* 200x200, creado 24/07/09 */
        google_ad_slot = "4443810839";
        google_ad_width = 200;
        google_ad_height = 200;
        //-->
    </script>
    <script type="text/javascript"
            src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
    </script>
</article>
EOD;
        return $html;
    }
}
