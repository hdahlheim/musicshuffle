<?php

use function Database\pdo;
use function Siler\Http\Response\html;
use function Siler\Twig\render;
use function Auth\checkAuthUser;
use function Database\countOf;
use function Database\getAllPlaylists;
use function Siler\Http\Request\get;

/**
 * Check if a user is logged in,
 */
checkAuthUser();

$limit = 10;
$page = (int) get('p', 1);
$start = $limit * ($page - 1);

$playlists = getAllPlaylists($limit, $start);

$total = countOf('playlists');

/**
 * The compact() function creates a key value array, render() puts the generated
 * array in the twig template and html() makes/sends it as a proper response
 * (header response)
 */
html(render('playlists/index.twig', compact('playlists', 'page', 'limit', 'total')));
