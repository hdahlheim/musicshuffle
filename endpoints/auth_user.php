<?php

use function Auth\authUser;
use function Database\pdo;
use function Siler\Http\Request\post;
use function Validators\setErrorAndRedirect;

$username = post('username');
$password = post('password');

$userQuery = pdo()->prepare('SELECT id, username, password FROM users WHERE username = :username');
$userQuery->execute(array('username' => $username));
$user = $userQuery->fetch(PDO::FETCH_ASSOC);

if ($user) {
    authUser($user, $password);
} else {
    setErrorAndRedirect('Login failed');
}

