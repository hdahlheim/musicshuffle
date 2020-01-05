<?php

use function Auth\checkAuthUser;
use function Database\getLastFivePlaylistsOfUser;
use function Database\pdo;
use function Siler\Http\Response\html;
use function Siler\Twig\render;

checkAuthUser();

$id = $params['id'];
$userQuery = pdo()->prepare(
    'SELECT username, email, id FROM users WHERE id=:id;'
);
$userQuery->bindParam('id', $id, PDO::PARAM_INT);
$userQuery->execute();

$user = $userQuery->fetch();
$playlists = getLastFivePlaylistsOfUser($user['id']);

html(render('users/show.twig', compact('user', 'playlists')));
