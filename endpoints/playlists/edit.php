<?php

use function Auth\canUserEditPlaylist;
use function Auth\checkAuthUser;
use function Database\getPlaylist;
use function Siler\Http\Response\html;
use function Siler\Twig\render;
use function Validators\validPlaylistId;

$id = (int) $params['id'];

checkAuthUser();

validPlaylistId($id);
canUserEditPlaylist($id);

$playlist = getPlaylist($id);

html(render('playlists/edit.twig', compact('playlist')));
