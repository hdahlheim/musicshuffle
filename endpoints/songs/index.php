<?php

use function Database\pdo;
use function Siler\Http\Response\html;
use function Siler\Twig\render;
use function Auth\checkAuthUser;

checkAuthUser();

$limit = 10;

$songsQuery = pdo()->prepare(
    'SELECT name, link, youtube_id FROM songs LIMIT :limit;'
);
$songsQuery->bindParam('limit', $limit, PDO::PARAM_INT);
$songsQuery->execute();

$songs = $songsQuery->fetchAll(\PDO::FETCH_ASSOC);

/**
 * The compact() function creates a key value array, render() puts the generated
 * array in the twig template and html() makes/sends it as a proper response
 * (header response)
 */
html(render('songs/index.twig', compact('songs')));
