<?php

use function Siler\Http\Response\html;
use function Siler\Twig\render;
use function Auth\isUserLoggedin;
use function Database\getLastFivePlaylistsOfUser;
use function Siler\Http\session;


$playlists = getLastFivePlaylistsOfUser(session('user_id'));

if (isUserLoggedin()) {
    html(render('home/home_loggedIn.twig', compact('playlists')));
} else {
    html(render('home/home_loggedOut.twig'));
}
