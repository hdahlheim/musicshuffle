<?php

use function Auth\checkAuthUser;
use function Database\pdo;
use function Siler\Http\redirect;
use function Siler\Http\Request\post;

checkAuthUser();

$name = post('name');
$user_id = $_SESSION['user_id'];

pdo()
    ->prepare(
        "INSERT INTO playlists (name, user_id)
        VALUES (:name, :user_id);"
    )
    ->execute(compact('name', 'user_id'));
$playlist_id = pdo()->lastInsertID();
redirect("/show/{$playlist_id}");
