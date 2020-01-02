<?php

use function Siler\Route\did_match;
use function Siler\Route\get;
use function Siler\Route\post;
use function Siler\Route\resource;

get('/', '../endpoints/home.php');

/**
 * Login Routes
 */
get('/login', '../endpoints/login.php');
post('/login', '../endpoints/auth_user.php');

/**
 * Logout route, destroyes the current session
 */
post('/logout', '../endpoints/logout.php');
get('/logout', '../endpoints/logout.php');


/**
 * Register route, displays the register form
 */
get('/register', '../endpoints/register.php');

/**
 * Registers routes for all seven CRUD actions, on the users resource.
 * Each action is represented by a php file with the action name.
 * Index, Create, Show, Store, Edit, Update, Delete.
 */
resource('/users', '../endpoints/users');

/**
 * Registers routes for all seven CRUD actions, on the playlists resource.
 * Each action is represented by a php file with the action name.
 * Index, Create, Show, Store, Edit, Update, Delete.
 */
resource('/playlists', '../endpoints/playlists');


if (!did_match()) notFoundError();

function notFoundError()
{
    http_response_code(404);
    echo 'Not found';
}
