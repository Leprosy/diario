<?php
namespace Lib;

class Extractor {
    public function __construct() {}

    public function getPosts($source, $totalPosts = 20) {
        //var_dump("Fetching " . $source);

        $settings = array(
                'oauth_access_token' => "15126770-1vj7YDtr7hI8Y7JYBJqf2UxtuTTEyf7VeanOAQb0",
                'oauth_access_token_secret' => "6MVu7sOtp49WgDMvDHDz1g2tb12BwrbZ0zpRsatBVk",
                'consumer_key' => "I3FVRGdjZONQBVX03SBte8dcp",
                'consumer_secret' => "cg9tywUVF3NH5h0flAagxSFDY6q5x1JSOQ2J41bQN9E96nXlrk"
        );

        $twitter = new \TwitterAPIExchange($settings);
        $reqUrl = "https://api.twitter.com/1.1/statuses/user_timeline.json";
        $getfield = sprintf("?count=%s&screen_name=%s", $totalPosts, $source);
        $requestMethod = "GET";
        $obj = json_decode($twitter->setGetfield($getfield)
                                   ->buildOauth($reqUrl, $requestMethod)
                                   ->performRequest());

        return $obj;
    }
}