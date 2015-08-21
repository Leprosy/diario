<?php
namespace Lib;

class Scraper {
    const fbSize = 1;
    const twSize = 1;

    public $adapter;

    public function __construct($adapter = null) {
        $className = sprintf("%s%sAdapter", 'Lib\\', ucwords($adapter));
        $this->adapter = new $className();
    }

    public function extract($post) {
        if (count($post->entities->urls) == 0) {
            var_dump("no url");
            return null;
        }

        $url = $this->resolveURL($post->entities->urls[0]->expanded_url);
        libxml_use_internal_errors(true);
        $doc = new \DOMDocument();
        $doc->loadHTMLFile($url);
        $xpath = new \DOMXpath($doc);

        // Build basic node
        $node = array(
            "title" => $xpath->evaluate("string(//meta[@property='og:title'][1]/@content)"),
            "url" => $url,
            "published" => strtotime($post->created_at),
            "image" => $xpath->evaluate("string(//meta[@property='og:image'][1]/@content)"),
            "text" => implode(' ', array_slice(explode(' ', $this->adapter->extractText($xpath)), 0, 100)),
            "fb" => Scraper::getFB($url),
            "tw" => Scraper::getTW($url),
            "source" => $post->user->screen_name
        );

        if ($node["title"] == "" || $node["text"] == "") {
            /*var_dump("ERROR");
            var_dump($node); */
            return null;
        } else {
            return $node;
        }
    }

    static function getFB($url) {
        $handler = curl_init('https://graph.facebook.com/?ids=' . $url);
        curl_setopt($handler, CURLOPT_RETURNTRANSFER, TRUE);
        $response = curl_exec($handler);
        curl_close($handler);
        $fb = json_decode($response);

        if (isset(current($fb)->shares)) {
            return (current($fb)->shares * Scraper::fbSize);
        } else {
            return 0;
        }
    }

    static function getTW($url) {
        $handler = curl_init('http://urls.api.twitter.com/1/urls/count.json?url=' . $url);
        curl_setopt($handler, CURLOPT_RETURNTRANSFER, TRUE);
        $response = curl_exec($handler);
        curl_close($handler);
        $tw = json_decode($response);

        return ($tw->count * Scraper::twSize);
    }

    public function resolveURL($url) {
        $headers = get_headers($url);
        $headers = array_reverse($headers);

        foreach($headers as $header) {
            if (strpos($header, 'Location: ') === 0) {
                $url = str_replace('Location: ', '', $header);
                break;
            }
        }

        return $url;
    }
}

class LaterceraAdapter {
    public function extractText($xpath) {
        return $xpath->evaluate("concat(//p[1]/text(), //p[2]/text(), //p[3]/text())");
    }
}

class EmolAdapter {
    public function extractText($xpath) {
        return $xpath->evaluate("string(//div[@class='EmolText'])");
    }
}

class El_dinamoAdapter {
    public function extractText($xpath) {
        return $xpath->evaluate("concat(//article/p[1]/text(), //article/p[2]/text(), //article/p[3]/text())");
    }
}

class ElmostradorAdapter {
    public function extractText($xpath) {
        return $xpath->evaluate("concat(//div/article/div/div/div/p[0], //div/article/div/div/div/p[1], //div/article/div/div/div/p[2])");
    }
}