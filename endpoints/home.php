<?php

use function Siler\Http\Response\html;
use function Siler\Twig\render;
use function Auth\checkAuthUser;
use function Siler\Http\redirect;

checkAuthUser();

redirect('/users');
//html(render('loggedin/home.twig'));
