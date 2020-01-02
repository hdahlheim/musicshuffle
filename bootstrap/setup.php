<?php

use Siler\Twig;

use function Auth\isUserLoggedin;
use function Siler\Http\flash;
use function Siler\Http\session;

$dotenv = Dotenv\Dotenv::create(__DIR__.'/..');
$dotenv->load();

/**
 * Initializes the Twig environment with the path to the template directory.
 * We use Twig for templating because it provides a nicer experience, than
 * writing plain php templates, and also prevents script injection.
 */
$twigEnv = Twig\init('../resources/templates/');

/**
 * Registers a global errorAlert Twig vairable, for use in the template.
 * The flash() function returns the value of the given a key in the
 * $_SESSION variable and deletes the entry from the session.
 * If the key dose not exists flash() will return null.
 */
$twigEnv->addGlobal('errorAlert', flash('errorAlert'));

/**
 * Registers a global infoAlert Twig vairable, for use in the template.
 * The flash() function returns the value of the given a key in the
 * $_SESSION variable and deletes the entry from the session.
 * If the key dose not exists flash() will return null.
 */
$twigEnv->addGlobal('infoAlert', flash('infoAlert'));

/**
 * Registers a global isLoggedIn Twig vairable, for use in the template.
 * The session() function returns the value of the given a key in the
 * $_SESSION variable, if the key dose not exists a default will be
 * returned. If no default is specified null will be returned.
 */
$twigEnv->addGlobal('isLoggedIn', isUserLoggedin());

