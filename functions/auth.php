<?php

namespace Auth;

use function Database\getPlaylistOwnerId;
use function Siler\Http\redirect;
use function Siler\Http\session;
use function Siler\Http\setsession;
use function Validators\setErrorAndRedirect;

/**
 * Checks if the session has an user (is logged in) and redirect if not
 */
function checkAuthUser()
{
    if (!isUserLoggedin()) {
        redirect('/logout');
        exit;
    }
}

/**
 * Checks if the user as the right to edit the requested user.
 * if this check fails the user will be redirected and a
 * error message will be displayed.
 *
 * @param integer $id
 * @return boolean|void
 */
function canUserEditUser($id)
{
    $userToEdit = (int) $id;
    $currentUser = (int) session('user_id');
    if ($currentUser !== $userToEdit) {
        setErrorAndRedirect('You can not edit this user');
    }
    return true;
}

/**
 * Checks if the user has the right to edit the requested playlist.
 * if this check fails the user will be redirected and a
 * error message will be displayed.
 *
 * @param integer $id
 * @return boolean|void
 */
function canUserEditPlaylist($id)
{
    $playlistUserId = (int) getPlaylistOwnerId($id);
    $currentUser = (int) session('user_id');
    if ($currentUser !== $playlistUserId) {
        setErrorAndRedirect('You can not edit this playlist');
    }
    return true;
}

/**
 * Checks if a user is logged in. And return a boolean.
 *
 * @return boolean
 */
function isUserLoggedin()
{
    $user_session = session('user_name');
    if (is_null($user_session)) {
        return false;
    }
    return true;
}

/**
 * Checks if the password is right
 * Redirect and set the session-infos if the password is right
 *
 * @param Array $user
 * @param string|void $password
 */
function authUser($user, $password)
{
    if (password_verify($password, $user['password'])) {
        session_regenerate_id(true);

        setsession('user_name', $user['username']);
        setsession('user_id', $user['id']);
        redirect('/');
        exit;
    } else {
        setErrorAndRedirect('Password is wrong');
    }
}
