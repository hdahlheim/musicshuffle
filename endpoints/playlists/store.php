<?php

use function Auth\checkAuthUser;
use function Database\storePlaylist;
use function Siler\Http\redirect;
use function Siler\Http\Request\post;
use function Siler\Http\session;
use function Validators\setErrorAndRedirect;
use function Validators\validCSRFToken;

checkAuthUser();
validCSRFToken();

$name = trim(post('name'));
$userId = session('user_id');

if ($name === '') {
    setErrorAndRedirect('please enter a playlistname');
}

$playlistId = storePlaylist($name, $userId);

redirect("/playlists/$playlistId");
