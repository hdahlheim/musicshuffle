<?php

/**
 * This file contains most of the project setup including loading environment
 * variables and setting up the Twig environment.
 */

use Siler\Twig;
use function Auth\isUserLoggedin;
use function Siler\Http\flash;
use function Siler\Http\session;
use function Validators\generateCSRFToken;

/**
 * Generate a Cross site request forgery protection token and saves it to
 * the current session.
 */
generateCSRFToken();

/**
 * Load the environment variables from the .env file.
 */
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

/**
 * Registers a global currentUserId Twig vairable, for use in the template.
 * The session() function returns the value of the given a key in the
 * $_SESSION variable, if the key dose not exists a default will be
 * returned. If no default is specified null will be returned.
 */
$twigEnv->addGlobal('currentUserId', session('user_id'));

/**
 * Registers a global path Twig vairable, for use in the template.
 * The path() function returns the current request path.
 */
$twigEnv->addGlobal('path', Siler\Http\path());

/**
 * Add the gravatar filter to Twig, this filer allows us to turn email addresses
 * into gravatar url for use in the templates.
 */
$twigEnv->addFilter(new \Twig\TwigFilter('gravatar', function ($email) {
    $encodedEmail = md5(strtolower(trim($email)));
    return "https://www.gravatar.com/avatar/{$encodedEmail}?d=retro";
}));

/**
 * Add the vtImg function to Twig, this function allows us to add youtube
 * thumbnails in diffrent sizes for a given youtube id to our application.
 */
$twigEnv->addFunction(
    new \Twig\TwigFunction(
    'ytImg',
    'YouTubeAPI\getYoutubeThumbnailURL'
)
);

/**
 * Add a csrf Input field function to Twig, this function allows us to add
 * csrf token fields everywhere in twig.
 */
$twigEnv->addFunction(
    new \Twig\TwigFunction('csrfField', function () {
        $token = session('csrf_token');
        echo "<input name=\"_csrf_token\" type=\"hidden\" value=\"$token\">";
    }, ['is_safe' => ['html']])
);
