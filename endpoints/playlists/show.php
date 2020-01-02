<?php

use function Auth\checkAuthUser;
use function Database\getPlaylist;
use function Database\pdo;
use function Siler\Http\Response\header;
use function Siler\Twig\render;
use function Siler\Http\Response\html;
use function Siler\Http\Response\json;
use function Validators\validPlaylistId;

checkAuthUser();

$id = $params['id'];
validPlaylistId($id);

$playlist = getPlaylist($id);

header('Feature-Policy', 'autoplay \'self\' https://youtube.com');
html(render('playlists/show.twig', compact('playlist')));
