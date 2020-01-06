<?php

use function Auth\checkAuthUser;
use function Database\storePlaylist;
use function Siler\Http\redirect;
use function Siler\Http\Request\post;
use function Siler\Http\session;
use function Validators\validCSRFToken;
use function Validators\validPlaylistname;

checkAuthUser();
validCSRFToken();

$userId = session('user_id');
$name = validPlaylistname(post('name'));

$playlistId = storePlaylist($name, $userId);

redirect("/playlists/$playlistId");
