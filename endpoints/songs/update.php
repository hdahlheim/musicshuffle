<?php

use function Auth\checkAuthUser;
use function Database\upVoteSong;
use function Siler\Http\Response\redirect;
use function Siler\Http\session;
use function Siler\Http\setsession;
use function Validators\setErrorAndRedirect;
use function Validators\validPlaylistId;
use function Validators\validSongId;
use function Validators\validUserId;

checkAuthUser();

$userId = (int) session('user_id');
$songId = (int) $params['song_id'];
$playlistId = (int) $params['id'];

validSongId($songId);
validUserId($userId);
validPlaylistId($playlistId);

$success = upVoteSong($userId, $playlistId, $songId);

if(!$success) {
    setErrorAndRedirect('Upvote failed, you have already upvoted this song');
}
setsession('infoAlert', 'Upvote successfully');

redirect("/playlists/$playlistId");
