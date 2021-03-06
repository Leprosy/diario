<?php

class Social {
    static public function getFB($url) {
        $handler = curl_init('https://graph.facebook.com/?ids=' . $url);
        curl_setopt($handler, CURLOPT_RETURNTRANSFER, TRUE);
        $response = curl_exec($handler);
        curl_close($handler);
        $fb = json_decode($response);

        if (isset(current($fb)->shares)) {
            return (current($fb)->shares * Config::fbSize);
        } else {
            return 0;
        }
    }

    static public function getTW($url) {
        $handler = curl_init('http://urls.api.twitter.com/1/urls/count.json?url=' . $url);
        curl_setopt($handler, CURLOPT_RETURNTRANSFER, TRUE);
        $response = curl_exec($handler);
        curl_close($handler);
        $tw = json_decode($response);

        return ($tw->count * Config::twSize);
    }
}
