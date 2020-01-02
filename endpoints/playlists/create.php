<?php

use function Auth\checkAuthUser;
use function Siler\Http\Response\html;
use function Siler\Twig\render;

checkAuthUser();

html(render('create_playlist.twig'));
