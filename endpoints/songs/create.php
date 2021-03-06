<?php

use function Auth\checkAuthUser;
use function Database\getPlaylist;
use function Siler\Http\Response\html;
use function Siler\Twig\render;
use function Validators\validPlaylistId;

checkAuthUser();

$playlistId = (int) $params['id'];

validPlaylistId($playlistId);
$playlist = getPlaylist($playlistId);

html(render('songs/create.twig', compact('playlist')));
