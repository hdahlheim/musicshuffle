<?php

use function Auth\checkAuthUser;
use function Database\getFivePlaylistsOfUser;
use function Database\getTotalNumberPlaylistsOfUser;
use function Database\pdo;
use function Siler\Http\Request\get;
use function Siler\Http\Response\html;
use function Siler\Twig\render;
use function Validators\validUserId;

checkAuthUser();

$id = (int) $params['id'];

validUserId($id);

$userQuery = pdo()->prepare(
    'SELECT username, email, id FROM users WHERE id=:id;'
);
$userQuery->bindParam('id', $id, PDO::PARAM_INT);
$userQuery->execute();

$user = $userQuery->fetch();

$limit = 5;

$page = (int) get('p', 1);
$playlists = getFivePlaylistsOfUser($user['id'], $page);

$total = getTotalNumberPlaylistsOfUser($user['id']);

html(render('users/show.twig', compact('user', 'playlists', 'page', 'limit', 'total')));
