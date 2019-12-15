<?php

use function Siler\Http\Response\html;
use function Siler\Twig\render;

$users = [
    ['id' => 3, 'username' => 'lsdfjkg', 'email' => 'slkdhf@sdkl.ch'],
    ['id' => 4, 'username' => 'lsfj', 'email' => 'slkdhf@sdkl.ch'],
    ['id' => 5, 'username' => 'skjf', 'email' => 'slkdhf@sdkl.ch']
];

// compact makes a key value array, render puts the generated array in the twigtmp and html() makes/sends it as a proper response (header response)
html(render('user_list.twig', compact('users')));

