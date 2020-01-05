<?php

use function Auth\checkAuthUser;
use function Database\addSongToPlaylist;
use function Database\storeSong;
use function Siler\Http\redirect;
use function Siler\Http\Request\post;
use function Validators\validCSRFToken;
use function Validators\validateYouTubeUrl;
use function Validators\validPlaylistId;
use function YouTubeAPI\getYouTubeVideoId;
use function YouTubeAPI\getYouTubeVideoName;

checkAuthUser();
validCSRFToken();

$playlistId = $params['id'];

validPlaylistId($playlistId);

$url = post('url');

validateYouTubeUrl($url);

$youtubeId = getYouTubeVideoId($url);
$videoName = getYouTubeVideoName($youtubeId);

$songId = storeSong($videoName, $url, $youtubeId);
addSongToPlaylist($songId, $playlistId);

redirect("/playlists/$playlistId");
