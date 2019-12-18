<?php

use function Siler\Http\Response\header;
use function Siler\Twig\render;
use function Siler\Http\Response\html;


header('Feature-Policy', 'autoplay \'self\' https://youtube.com');
html(render('play_playlist.twig'));
