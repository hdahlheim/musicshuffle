<?php

use function Auth\checkAuthUser;
use function Database\countOfPlaylistsByUser;
use function Database\getPlaylistsByUser;
use function Database\getUserById;
use function Siler\Http\Request\get;
use function Siler\Http\Response\html;
use function Siler\Twig\render;
use function Validators\validUserId;

checkAuthUser();

$id = (int) $params['id'];

validUserId($id);

$user = getUserById($id);

$limit = 5;
$page = (int) get('p', 1);
$playlists = getPlaylistsByUser($user['id'], $limit, $page);
$total = countOfPlaylistsByUser($user['id']);

html(
    render(
        'users/show.twig',
        compact('user', 'playlists', 'page', 'limit', 'total')
    )
);
