<?php

use function Database\pdo;
use function Siler\Http\redirect;
use function Siler\Http\Request\post;

$name = post('name');

pdo()
    ->prepare(
        "INSERT INTO playlists (name)
        VALUES (name)"
    )
    ->execute(compact('name'));
$playlist_id = pdo()->lastInsertID();
redirect("/show/{$playlist_id}");
