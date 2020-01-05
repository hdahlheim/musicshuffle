<?php

use function Auth\authUser;
use function Database\getUserByName;
use function Database\pdo;
use function Siler\Http\Request\post;
use function Validators\setErrorAndRedirect;
use function Validators\validCSRFToken;

validCSRFToken();

$username = post('username');
$password = post('password');

$user = getUserByName($username);

if ($user) {
    authUser($user, $password);
} else {
    setErrorAndRedirect('Login failed');
}
