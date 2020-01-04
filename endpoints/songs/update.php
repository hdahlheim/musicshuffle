<?php

use function Auth\checkAuthUser;
use function Database\upVoteSong;
use function Siler\Http\Response\redirect;
use function Siler\Http\session;
use function Validators\validPlaylistId;

checkAuthUser();

$playlistId = (int) $params['id'];
$songId = (int) $params['song_id'];
$userId = (int) session('user_id');

validPlaylistId($playlistId);


upVoteSong($userId, $playlistId, $songId);

redirect("/playlists/$playlistId");
