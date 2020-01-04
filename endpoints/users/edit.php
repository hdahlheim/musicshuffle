<?php

use function Auth\checkAuthUser;
use function Auth\checkUserEditRight;
use function Database\pdo;
use function Siler\Http\Response\html;
use function Siler\Twig\render;

checkAuthUser();
checkUserEditRight($params['id']);

$id = $params['id'];
$userQuery = pdo()->prepare(
    'SELECT username, email, id FROM users WHERE id=:id;'
);
$userQuery->bindParam('id', $id, PDO::PARAM_INT);
$userQuery->execute();

$user = $userQuery->fetch();

html(render('users/edit.twig', compact('user')));