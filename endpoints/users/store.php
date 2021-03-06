<?php

use function Database\storeUser;
use function Siler\Http\redirect;
use function Siler\Http\Request\post;
use function Siler\Http\setsession;
use function Validators\setErrorAndRedirect;
use function Validators\validCSRFToken;
use function Validators\validPassword;
use function Validators\validEmail;
use function Validators\validUsername;

validCSRFToken();
$email = validEmail(post('email'));
$username = validUsername(post('username'));
$password = validPassword(post('password'), post('password_check'));

$success = storeUser($email, $username, $password);

if (!$success) {
    setErrorAndRedirect('Registration failed');
}

setsession('infoAlert', 'Registration successfull');
redirect('/login');
