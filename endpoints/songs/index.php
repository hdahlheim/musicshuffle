<?php

/**
 * This file is actually never called in the current version of the project
 */

use function Siler\Http\Response\html;
use function Siler\Twig\render;
use function Auth\checkAuthUser;
use function Database\getAllSongs;

checkAuthUser();

$limit = 10;

$songs = getAllSongs($limit);

/**
 * The compact() function creates a key value array, render() puts the generated
 * array in the twig template and html() makes/sends it as a proper response
 * (header response)
 */
html(render('songs/index.twig', compact('songs')));
