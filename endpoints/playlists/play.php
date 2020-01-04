<?php

use function Auth\checkAuthUser;
use function Database\getPlaylist;
use function Siler\Http\Response\header;
use function Siler\Twig\render;
use function Siler\Http\Response\html;
use function Validators\validPlaylistId;

checkAuthUser();
validPlaylistId($params['id']);

$playlist = getPlaylist($id);

header('Feature-Policy', 'autoplay \'self\' https://youtube.com');
html(render('playlists/play.twig', compact('playlist')));
