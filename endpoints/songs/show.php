<?php

use function Auth\checkAuthUser;
use function Database\pdo;
use function Siler\Http\Response\html;
use function Siler\Twig\render;
use function Validators\validSongId;

checkAuthUser();

$id = (int) $params['id'];

validSongId($id);

$songQuery = pdo()->prepare(
    'SELECT name, url, youtube_id, id FROM songs
    WHERE id=:id;'
);
$songQuery->bindParam('id', $id, PDO::PARAM_INT);
$songQuery->execute();

$song = $songQuery->fetch();

html(render('songs/show.twig', compact('song')));
