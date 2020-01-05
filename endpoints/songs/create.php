<?php

use function Auth\checkAuthUser;
use function Siler\Http\Response\html;
use function Siler\Twig\render;

checkAuthUser();

html(render('songs/create.twig', ['playlist_id' => $params['id']]));
