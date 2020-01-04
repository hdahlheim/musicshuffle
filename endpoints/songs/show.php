<?php

use function Auth\checkAuthUser;
use function Database\pdo;
use function Siler\Http\Response\html;
use function Siler\Twig\render;

checkAuthUser();

$id = $params['id'];
$songQuery = pdo()->prepare(
    'SELECT s.name, s.link, s.youtube_id, s.id FROM songs AS s
    LEFT JOIN playlist_items as pi ON s.id = pi.song_id
    LEFT JOIN upvotes as uv ON s.id = pi.song_id

    WHERE id=:id;'
);
$songQuery->bindParam('id', $id, PDO::PARAM_INT);
$songQuery->execute();

$song = $songQuery->fetch();

html(render('songs/show.twig', compact('song')));
