<?php

namespace YouTubeAPI;

use function Siler\array_get;
use function Siler\Dotenv\env;

function getYouTubeVideoId($url) {
    // youtube_id generieren
    $query = parse_url($url, PHP_URL_QUERY);
    $query_array = explode('&', $query);

    /**
     * Use Array Reduce to go over every entry in the query_array an create a new
     * key => value array with the query param as key and the value as value
     * @var array
     */
    $query_array_asoc = array_reduce($query_array, function($accumulator, $item){
        [$key, $value] = explode('=', $item);
        $accumulator[$key] = $value;
        return $accumulator;
    }, []);

    return array_get($query_array_asoc, 'v', '');
}

function getYouTubeVideoName($id) {
    $apiKey = env('YOUTUBE_API_KEY');
    $data = json_decode(file_get_contents("https://www.googleapis.com/youtube/v3/videos?part=snippet&id=$id&key=$apiKey"));
    return $data->items[0]->snippet->title;
}

