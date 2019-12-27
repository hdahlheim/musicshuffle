<?php

use function Siler\Http\Response\html;
use function Siler\Twig\render;
use function Auth\checkAuthUser;

checkAuthUser();

html(render('Home.twig'));
