<?php

use function Auth\checkAuthUser;
use function Database\getSongById;
use function Database\pdo;
use function Siler\Http\Response\html;
use function Siler\Twig\render;
use function Validators\validSongId;

checkAuthUser();

$id = (int) $params['id'];

validSongId($id);

$song = getSongById($id);

html(render('songs/show.twig', compact('song')));
