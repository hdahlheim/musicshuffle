<?php

use function Database\pdo;
use function Siler\Http\redirect;
use function Siler\Http\Request\post;
use function Validators\valid_password;
use function Validators\valid_email;
use function Validators\valid_username;

$email = valid_email(post('email'));
$username = valid_username(post('username'));
$password = valid_password(post('password'));

pdo()
    ->prepare(
        "INSERT INTO users (username, password, email)
        VALUES (:username, :password, :email)"
    )
    ->execute(compact('username', 'password', 'email'));

redirect('/users/create');
