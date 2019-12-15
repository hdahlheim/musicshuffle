<?php

namespace Validators;

use function Siler\Http\redirect;
use function Siler\Http\Request\post;
use function Siler\Http\setsession;

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

function valid_username($rawUsername)
{
    $username = htmlspecialchars(trim($rawUsername));

    if (empty($username)) {
        setErrorAndRedirect('Username is empty');
    }
    return $username;
}

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


function setErrorAndRedirect($error)
{
    setsession('errorAlert', $error);
    redirect(\Siler\Http\Request\header('Referer'));
    exit;
}
