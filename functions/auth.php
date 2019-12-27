<?php

namespace Auth;

use function Siler\Functional\isnull;
use function Siler\Http\session;
use function Validators\setErrorAndRedirect;
use function Siler\Http\redirect;

/**
 * Checks if the session has an user (is logged in) and redirect if not
 */
function checkAuthUser()
{
    $user_session = session('user_name');
    if (is_null($user_session)){
        redirect('/logout');
        exit;
    }
}

/**
 * Checks if the password is right
 * Redirect and set the session-infos if the password is right
 *
 * @param Array $user
 * @param String $password
 */
function authUser($user, $password)
{
if (password_verify($password, $user['password'])) {
    session_regenerate_id();

    $_SESSION['user_name'] = $user;
    $_SESSION['user_id'] = $user['id'];
    redirect('/');
    exit;
}
else {
    setErrorAndRedirect('Password is wrong');
}
}


