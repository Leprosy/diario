<?php

class Builder {
    static public $feeds = array(
        'El Mostrador' => 'http://www.elmostrador.cl/feed/',
        'El Mostrador Mercados' => 'http://www.elmostradormercados.cl/feed/',
        'ALT1040' => 'http://feeds.hipertextual.com/alt1040',
        'El Dínamo' => 'http://www.eldinamo.cl/feed/'
    );

    static public function build() {
        $old_reporting = error_reporting(error_reporting() & ~E_STRICT);

        $RSS = new SimplePie();
        $RSS->set_cache_location('cache/');
        $RSS->set_cache_duration(0);

        /* Read the feeds */
        foreach (self::$feeds as $name => $url) {
            echo "<hr>" . $name . "\n";
            $RSS->set_feed_url($url);
            $RSS->init();

            foreach ($RSS->get_items() as $item) {
                $text = strip_tags($item->get_content());

                $post          = new stdClass();
                $post->date    = (strtotime($item->get_date()));
                $post->title   = ($item->get_title());
                $post->source  = ($name);
                $post->link    = current(explode('?', $item->get_link()));
                $post->content = Html::words($text, 70);
                $post->thumb   = self::scrapImg($post->link);

                /* Calculating social weight */
                $post->social = 0;
                //FB
                $post->social += Social::getFB($post->link);
                //TW
                $post->social += Social::getTW($post->link);

                /* Add tags */
                $T = new Tagger();
                $T->tokenize($post->title, 2);
                $T->tokenize($text);
                //var_dump($T->getTags());

                /* save content */
                if ($post->content != '') {
                    var_dump($post);
                    echo Db::savePost($post) . "\n";
                }

                echo "<hr>";
            }
        }
    }

    static public function scrapImg($url) {
        $handler = curl_init($url);
        curl_setopt($handler, CURLOPT_RETURNTRANSFER, TRUE);
        $data = curl_exec($handler);
        curl_close($handler);

        $match = array();
        preg_match('/og:image"[ ]+content="(.+)"/', $data, $match);

        if (isset($match[1])) {
            $img = preg_replace('/-[0-9]+x[0-9]+/', '', $match[1]);

            if (strpos($img, 'elmostrador.png')===false) {
                return $img;
            } else {
                return '';
            }
        } else {
            return '';
        }
    }
}
