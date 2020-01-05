<?php

use function Auth\authUser;
use function Database\pdo;
use function Siler\Http\Request\post;
use function Validators\setErrorAndRedirect;

$username = post('username');
$password = post('password');
$passwordCheck = post('password_check');

$userQuery = pdo()->prepare('SELECT id, username, password FROM users WHERE username = :username');
$userQuery->execute(array('username' => $username));
$user = $userQuery->fetch(PDO::FETCH_ASSOC);

if ($user) {
    authUser($user, $password, $passwordCheck);
} else {
    setErrorAndRedirect('Login failed');
}

