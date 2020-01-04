<?php

use function Siler\Http\Response\html;
use function Siler\Twig\render;
use function Auth\isUserLoggedin;

if (isUserLoggedin()) {
    html(render('home/loggedin.twig'));
} else {
    html(render('home/loggedout.twig'));
}
