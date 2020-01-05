<?php

use function Database\pdo;
use function Siler\Http\Response\html;
use function Siler\Twig\render;
use function Auth\checkAuthUser;
use function Siler\Container\get;

checkAuthUser();

$limit = 10;
$page = (int) get('p', 1);
$start = $limit * ($page - 1);

$userQuery = pdo()->prepare(
    'SELECT username, email, id FROM users LIMIT :start,:limit;'
);
$userQuery->bindParam('limit', $limit, PDO::PARAM_INT);
$userQuery->bindParam('start', $start, PDO::PARAM_INT);
$userQuery->execute();

$total = pdo()
            ->query('SELECT count(id) as count from users;')
            ->fetch(\PDO::FETCH_ASSOC)['count'];


$users = $userQuery->fetchAll();

/**
 * The compact() function creates a key value array, render() puts the generated
 * array in the twig template and html() makes/sends it as a proper response
 * (header response)
 */
html(render('users/index.twig', compact('users', 'page', 'limit', 'total')));
