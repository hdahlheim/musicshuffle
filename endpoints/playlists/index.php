<?php

use function Database\pdo;
use function Siler\Http\Response\html;
use function Siler\Twig\render;
use function Auth\checkAuthUser;
use function Siler\Http\Request\get;

checkAuthUser();

$limit = 10;
$page = (int) get('p', 1);
$start = $limit * ($page - 1);

$playlistsQuery = pdo()->prepare(
    'SELECT name, created, id, user_id FROM playlists LIMIT :start,:limit;'
);
$playlistsQuery->bindParam('limit', $limit, PDO::PARAM_INT);
$playlistsQuery->bindParam('start', $start, PDO::PARAM_INT);
$playlistsQuery->execute();
$total = pdo()
            ->query('SELECT count(id) as count from playlists;')
            ->fetch(\PDO::FETCH_ASSOC)['count'];

$playlists = $playlistsQuery->fetchAll();

/**
 * The compact() function creates a key value array, render() puts the generated
 * array in the twig template and html() makes/sends it as a proper response
 * (header response)
 */
html(render('playlists/index.twig', compact('playlists', 'page', 'limit', 'total')));
