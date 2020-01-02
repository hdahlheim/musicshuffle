<?php

use function Database\pdo;
use function Siler\Http\Response\html;
use function Siler\Twig\render;
use function Auth\checkAuthUser;

checkAuthUser();

$limit = 10;

$playlistsQuery = pdo()->prepare(
    'SELECT name, created, id, user_id FROM playlists LIMIT :limit;'
);
$playlistsQuery->bindParam('limit', $limit, PDO::PARAM_INT);
$playlistsQuery->execute();

$playlists = $playlistsQuery->fetchAll();

/**
 * The compact() function creates a key value array, render() puts the generated
 * array in the twig template and html() makes/sends it as a proper response
 * (header response)
 */
html(render('playlists/index.twig', compact('playlists')));
