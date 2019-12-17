<?php

namespace Validators;

use function Siler\Http\redirect;
use function Siler\Http\Request\post;
use function Siler\Http\setsession;

/**
 * Takes a raw string and checks if this string is a valid password
 * if password is valid, the encripted password will be returned
 * if not, the user will be redirected to the request origin.
 *
 * @param string $rawPassword
 * @return string
 */
function valid_password($rawPassword)
{
    $password = trim($rawPassword);

    if (empty($password)) {
        setErrorAndRedirect('Password is empty');
    }

    if (strlen($password) <= 8) {
        setErrorAndRedirect('Password is to short please enter more than 8 chars');
    }

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
function valid_username($rawUsername)
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
function valid_email($rawEmail)
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
