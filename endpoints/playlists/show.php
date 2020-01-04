<?php

use function Auth\checkAuthUser;
use function Database\getPlaylist;
use function Siler\Http\Response\header;
use function Siler\Twig\render;
use function Siler\Http\Response\html;
use function Validators\validPlaylistId;

checkAuthUser();

$id = $params['id'];
validPlaylistId($id);

$playlist = getPlaylist($id);

html(render('playlists/show.twig', compact('playlist')));
