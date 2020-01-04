<?php

use function Auth\checkAuthUser;
use function Database\upVoteSong;
use function Siler\Http\Response\redirect;
use function Siler\Http\session;
use function Validators\validPlaylistId;
use function Validators\validSongId;

checkAuthUser();

$userId = (int) session('user_id');
$songId = (int) $params['song_id'];
$playlistId = (int) $params['id'];

validPlaylistId($playlistId);
validSongId($playlistId);
upVoteSong($userId, $playlistId, $songId);

redirect("/playlists/$playlistId");
