<?php

use function Auth\checkAuthUser;
use function Database\addSongToPlaylist;
use function Database\saveSong;
use function Siler\array_get;
use function Siler\Http\redirect;
use function Siler\Http\Request\post;
use function Validators\setErrorAndRedirect;
use function Validators\validPlaylistId;

checkAuthUser();

$playlist_id = $params['id'];
validPlaylistId($playlist_id);

$name = post('name');
$url = post('url');



if(parse_url($url, PHP_URL_HOST) != 'www.youtube.com') {
    setErrorAndRedirect('the url should be from youtube.com');
}

// youtube_id generieren
$query = parse_url($url, PHP_URL_QUERY);
$query_array = explode('&', $query);

/** Henning bitte sehr langer Kommentar */
/**
 * @var array
 */
$query_array_asoc = array_reduce($query_array, function($accumulator, $item){
    [$key, $value] = explode('=', $item);
    $accumulator[$key] = $value;
    return $accumulator;
}, []);


$youtube_id = array_get($query_array_asoc, 'v', '');

if (empty($youtube_id)) {
    setErrorAndRedirect('The id is missing');
}
if(strlen($youtube_id) != 11) {
    setErrorAndRedirect('The video-id is to short/long');
}


$song_id = saveSong($name, $url, $youtube_id);
addSongToPlaylist($song_id, $playlist_id);

redirect("/playlists/$playlist_id");
