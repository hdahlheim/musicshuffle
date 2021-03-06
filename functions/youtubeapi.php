<?php

namespace YouTubeAPI;

use function Siler\array_get;
use function Siler\Dotenv\env;

/**
 * Parses a youtube url and return the video ID
 *
 * @param string $url
 * @return String
 */
function getYouTubeVideoId($url)
{
    $query = parse_url($url, PHP_URL_QUERY);
    $query_array = explode('&', $query);

    /**
     * Use Array Reduce to go over every entry in the query_array an create a new
     * key => value array with the query param as key and the value as value
     * @var array
     */
    $queryArrayAsoc = array_reduce($query_array, function ($accumulator, $item) {
        [$key, $value] = explode('=', $item);
        $accumulator[$key] = $value;
        return $accumulator;
    }, []);

    return array_get($queryArrayAsoc, 'v', '');
}

/**
 * A makes an youtube api request to get the video titel for a given video id.
 * This functions need a youtube api key to work.
 *
 * @param string $id
 * @return String
 */
function getYouTubeVideoName($id)
{
    $apiKey = env('YOUTUBE_API_KEY');
    $data = json_decode(file_get_contents("https://www.googleapis.com/youtube/v3/videos?part=snippet&id=$id&key=$apiKey"));
    return $data->items[0]->snippet->title;
}

/**
 * Returns a youtube thumbnail url for a given video ID in the specified quality
 *
 * @param string $id
 * @param integer $size
 * @return void
 */
function getYoutubeThumbnailURL($id, $size = 0)
{
    switch ($size) {
        case 0:
            $realSize = 'default';
            break;
        case 1:
            $realSize = 'mqdefault';
            break;
        case 2:
            $realSize = 'hqdefault';
            break;
        case 3:
            $realSize = 'sddefault';
            break;
        case 4:
            $realSize = 'maxresdefault';
            break;
        default:
            $realSize = 'default';
            break;
    }
    return "https://i.ytimg.com/vi/$id/$realSize.jpg";
}
