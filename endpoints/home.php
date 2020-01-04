<?php

use function Siler\Http\Response\html;
use function Siler\Twig\render;
use function Auth\isUserLoggedin;

if (isUserLoggedin()) {
    html(render('home/home_loggedIn.twig'));
} else {
    html(render('home/home_loggedOut.twig'));
}
