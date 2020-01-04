<?php

use function Auth\checkAuthUser;
use function Database\pdo;
use function Database\savePlaylist;
use function Siler\Http\redirect;
use function Siler\Http\Request\post;

checkAuthUser();

$name = post('name');
$user_id = $_SESSION['user_id'];

$playlist_id = savePlaylist($name, $user_id);

redirect("/playlists/$playlist_id/add-song");
