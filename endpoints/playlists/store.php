<?php

use function Auth\checkAuthUser;
use function Database\savePlaylist;
use function Siler\Http\redirect;
use function Siler\Http\Request\post;
use function Validators\setErrorAndRedirect;

checkAuthUser();

$name = trim(post('name'));
$user_id = $_SESSION['user_id'];

if ($name === '') {
    setErrorAndRedirect('please enter a playlistname');
}

$playlist_id = savePlaylist($name, $user_id);
redirect("/playlists/$playlist_id/add-song");
