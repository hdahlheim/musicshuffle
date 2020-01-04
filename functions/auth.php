<?php

namespace Auth;

use function Siler\Http\session;
use function Validators\setErrorAndRedirect;
use function Siler\Http\redirect;
use function Siler\Http\setsession;

/**
 * Checks if the session has an user (is logged in) and redirect if not
 */
function checkAuthUser() {
    if (!isUserLoggedin()){
        redirect('/logout');
        exit;
    }
}

function checkUserEditRight($id) {
    $userToEdit = (int) $id;
    $currentUser = (int) session('user_id');
    if ($currentUser !== $userToEdit) {
        setErrorAndRedirect('You can not edit this user');
    }
}



function isUserLoggedin() {
    $user_session = session('user_name');
    if (is_null($user_session)){
        return false;
    }
    return true;
}

/**
 * Checks if the password is right
 * Redirect and set the session-infos if the password is right
 *
 * @param Array $user
 * @param String $password
 */
function authUser($user, $password) {
    if (password_verify($password, $user['password'])) {
        session_regenerate_id();

        setsession('user_name', $user['username']);
        setsession('user_id', $user['id']);
        redirect('/');
        exit;
    } else {
        setErrorAndRedirect('Password is wrong');
    }
}


