<?php

use function Database\pdo;
use function Siler\Http\Response\html;
use function Siler\Twig\render;

$limit = 10;

$userQuery = pdo()
    ->prepare('SELECT username, email, id FROM users LIMIT :limit;');
$userQuery->bindParam('limit', $limit, PDO::PARAM_INT);
$userQuery->execute();
$users = $userQuery->fetchAll();
// compact makes a key value array, render puts the generated array in the twigtmp and html() makes/sends it as a proper response (header response)
html(render('user_list.twig', compact('users')));

