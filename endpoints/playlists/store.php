<?php

use function Database\pdo;
use function Siler\Http\redirect;
use function Siler\Http\Request\post;
use function Validators\valid_password;
use function Validators\valid_email;
use function Validators\valid_username;

$name = post('name');
$user_id = $_SESSION['user_id'];

pdo()
    ->prepare(
        "INSERT INTO users (user_id, name)
        VALUES (:user_id, :name)"
    )
    ->execute(compact('name', 'user_id'));
$playlist_id = pdo()->lastInsertID();
redirect("/show/{$playlist_id}");
