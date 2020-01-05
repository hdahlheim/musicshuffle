<?php

use function Siler\Http\Response\html;
use function Siler\Twig\render;
use function Auth\isUserLoggedin;
use function Database\getFivePlaylistsOfUser;
use function Database\getTotalNumberPlaylistsOfUser;
use function Siler\Http\Request\get;
use function Siler\Http\session;

if (isUserLoggedin()) {
    $limit = 5;

    $page = (int) get('p', 1);

    $total = getTotalNumberPlaylistsOfUser(session('user_id'));

    $playlists = getFivePlaylistsOfUser(session('user_id'), $page);

    html(render('home/home_loggedIn.twig', compact('playlists', 'page', 'limit', 'total')));
} else {
    html(render('home/home_loggedOut.twig'));
}
