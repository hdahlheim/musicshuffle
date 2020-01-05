<?php

use function Siler\Http\Response\html;
use function Siler\Twig\render;
use function Auth\isUserLoggedin;
use function Database\getFivePlaylistsOfUser;
use function Siler\Http\session;


$playlists = getFivePlaylistsOfUser(session('user_id'));

if (isUserLoggedin()) {
    html(render('home/home_loggedIn.twig', compact('playlists')));
} else {
    html(render('home/home_loggedOut.twig'));
}
