<?php

use function Auth\checkAuthUser;
use function Siler\Http\Response\html;
use function Siler\Twig\render;

/**
 * Check if a user is logged in,
 */
checkAuthUser();

html(render('playlists/create.twig'));
