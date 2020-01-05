<?php

use function Siler\Http\Response\html;
use function Siler\Twig\render;
use function Auth\isUserLoggedin;
use function Database\countOfPlaylistsByUser;
use function Database\getPlaylistsByUser;
use function Siler\Http\Request\get;
use function Siler\Http\session;

if (isUserLoggedin()) {
    $limit = 5;

    $page = (int) get('p', 1);

    $total = countOfPlaylistsByUser(session('user_id'));

    $playlists = getPlaylistsByUser(session('user_id'), $limit, $page);

    html(render('home/home_loggedIn.twig', compact('playlists', 'page', 'limit', 'total')));
} else {
    html(render('home/home_loggedOut.twig'));
}
