<?php

use function Database\pdo;
use function Siler\Http\Response\html;
use function Siler\Twig\render;
use function Auth\checkAuthUser;

checkAuthUser();

$limit = 10;

$userQuery = pdo()->prepare(
    'SELECT username, email, id FROM users LIMIT :limit;'
);
$userQuery->bindParam('limit', $limit, PDO::PARAM_INT);
$userQuery->execute();

$users = $userQuery->fetchAll();

/**
 * The compact() function creates a key value array, render() puts the generated
 * array in the twig template and html() makes/sends it as a proper response
 * (header response)
 */
html(render('users/index.twig', compact('users')));
