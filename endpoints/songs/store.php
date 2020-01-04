<?php

use function Auth\checkAuthUser;
use function Database\addSongToPlaylist;
use function Database\saveSong;
use function Siler\Http\redirect;
use function Siler\Http\Request\post;
use function Validators\validateYouTubeUrl;
use function Validators\validPlaylistId;
use function YouTubeAPI\getYouTubeVideoId;
use function YouTubeAPI\getYouTubeVideoName;

checkAuthUser();

$playlist_id = $params['id'];
$url = post('url');

validPlaylistId($playlist_id);
validateYouTubeUrl($url);
$youtubeId = getYouTubeVideoId($url);
$videoName = getYouTubeVideoName($youtubeId);

$song_id = saveSong($videoName, $url, $youtubeId);
addSongToPlaylist($song_id, $playlist_id);

redirect("/playlists/$playlist_id");
