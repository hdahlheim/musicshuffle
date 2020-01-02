<?php

use function Auth\checkAuthUser;
use function Database\pdo;
use function Siler\Http\Response\header;
use function Siler\Twig\render;
use function Siler\Http\Response\html;

checkAuthUser();

$id = $params['id'];
$playlistQuery = pdo()->prepare(
    'SELECT name, created, updated, user_id FROM playlists WHERE id=:id;'
);
$playlistQuery->bindParam('id', $id, PDO::PARAM_INT);
$playlistQuery->execute();

$playlist = $playlistQuery->fetch();

header('Feature-Policy', 'autoplay \'self\' https://youtube.com');
html(render('playlists/play.twig', compact('playlist')));
