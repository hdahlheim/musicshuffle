<?php

use function Database\pdo;
use function Siler\Http\redirect;
use function Siler\Http\Request\post;
use function Siler\Http\setsession;
use function Validators\setErrorAndRedirect;
use function Validators\valid_password;
use function Validators\valid_email;
use function Validators\valid_username;

$email = valid_email(post('email'));
$username = valid_username(post('username'));
$password = valid_password(post('password'));

$success = pdo()
    ->prepare(
        "INSERT INTO users (username, password, email)
        VALUES (:username, :password, :email)"
    )
    ->execute(compact('username', 'password', 'email'));
if(!$success){
    setErrorAndRedirect('Registration failed');
}
setsession('infoAlert', 'Registration successfull');
redirect('/login');
