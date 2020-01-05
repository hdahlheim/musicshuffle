<?php

namespace Validators;

use PDO;
use function Database\pdo;
use function Errors\notFoundError;
use function Siler\Http\redirect;
use function Siler\Http\setsession;


/**
 * Takes a raw string and checks if this string is a valid password
 * if password is valid, the encripted password will be returned
 * if not, the user will be redirected to the request origin.
 *
 * @param string $rawPassword
 * @return string
 */
function validPassword($rawPassword, $rawPasswordCheck)
{
    $password = trim($rawPassword);
    $passwordCheck = trim($rawPasswordCheck);

    if  ($password !== $passwordCheck) {
        setErrorAndRedirect('Passwords do not match');
    }

    if (empty($password)) {
        setErrorAndRedirect('Password is empty');
    }

    if (strlen($password) <= 8) {
        setErrorAndRedirect('Password is to short please enter more than 8 chars');
    }

    // wenn wir vergessen das wieder rein zu machen tut uns das leid wir haben aber
    // ganz ganz sicher dran gedacht! Ehrenwort :^)
    // if (!preg_match('/(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/', $password)) {
    //     setErrorAndRedirect('Password need specialchars');
    // }

    return password_hash($password, PASSWORD_DEFAULT);
}

/**
 * Takes a raw string and checks if it qualifies as a valid Username.
 * If the string qualifies as a Username, it will be returned as
 * an sanitized string. If not the user will be redirected.
 *
 * @param string $rawUsername
 * @return string
 */
function validUsername($rawUsername)
{
    $username = htmlspecialchars(trim($rawUsername));

    if (empty($username)) {
        setErrorAndRedirect('Username is empty');
    }
    return $username;
}

/**
 * Takes a raw string and checks if it qualifies as a valid e-mail address.
 * If the string qualifies as an e-mail address, it will be returned.
 * Else the user will be redirected, to the origin of the request.
 *
 * @param string $rawEmail
 * @return string
 */
function validEmail($rawEmail)
{
    $email = trim($rawEmail);

    if (empty($email)) {
        setErrorAndRedirect('Email is empty');
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        setErrorAndRedirect('Email is not valid please try again');
    }

    return $email;
}

function validPlaylistId($playlistId) {
    $query = pdo()->prepare('SELECT * FROM playlists WHERE id=:playlistId');
    $query->execute(compact('playlistId'));
    $playlist = $query->fetch(PDO::FETCH_ASSOC);
    if (empty($playlist)){
        notFoundError();
    }
    return true;
}

function validSongId($songId) {
    $query = pdo()->prepare('SELECT * FROM songs WHERE id=:songId');
    $query->execute(compact('songId'));
    $song = $query->fetch(PDO::FETCH_ASSOC);
    if (empty($song)){
        notFoundError();
    }
    return true;
}

function validUserId($userId) {
    $query = pdo()->prepare('SELECT * FROM users WHERE id=:userId');
    $query->execute(compact('userId'));
    $user = $query->fetch(PDO::FETCH_ASSOC);
    if (empty($user)){
        notFoundError();
    }
    return true;
}

function validateYouTubeUrl($url) {
    $url = trim($url);

    if ($url === '') {
        setErrorAndRedirect('please enter a url');
    }

    if(parse_url($url, PHP_URL_HOST) != 'www.youtube.com') {
        setErrorAndRedirect('the url should be from youtube.com');
    }
}

function validateYouTubeId($youtubeId) {
    if (empty($youtubeId)) {
        setErrorAndRedirect('The id is missing');
    }
    if(strlen($youtubeId) != 11) {
        setErrorAndRedirect('The video-id is to short/long');
    }
}


/**
 * Takes an error and saves it to the sseion for reuse on other pages,
 * after that, the user will be redirected to the point of origin,
 * and the script exits.
 *
 * @param string $error
 * @return void
 */
function setErrorAndRedirect($error)
{
    setsession('errorAlert', $error);
    redirect(\Siler\Http\Request\header('Referer'));
    exit;
}
