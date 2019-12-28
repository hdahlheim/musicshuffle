<?php

use function Auth\checkAuthUser;
use function Database\pdo;
use function Siler\Http\Response\header;
use function Siler\Twig\render;
use function Siler\Http\Response\html;

checkAuthUser();

//pdo request with songlist

header('Feature-Policy', 'autoplay \'self\' https://youtube.com');
html(render('playlists/play.twig'));
