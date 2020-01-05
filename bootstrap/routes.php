<?php

/**
 * The Routes file contains all the endpoints our application is capebal to
 * handel. We use Siler Route functions for routing.
 */

use function Siler\Route\get;
use function Siler\Route\post;
use function Siler\Route\put;
use function Siler\Route\resource;
use function Siler\Route\did_match;

/**
 * Display the Home page
 */
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

/**
 * Show the Player screen for playing the playlist in the vue.js player
 */
get('/playlists/{id}/play', '../endpoints/playlists/play.php');

/**
 * Endpoints for showing, adding and updating songs. These endpoints don't
 * follow the same url pattern that the other endpoints follow.
 */
get('/songs/{id}', '../endpoints/songs/show.php');
post('/playlists/{id}/songs', '../endpoints/songs/store.php');
get('/playlists/{id}/songs/create', '../endpoints/songs/create.php');
put('/playlists/{id}/songs/{song_id}', '../endpoints/songs/update.php');

/**
 * If no page endpoint matches the requested endpoint we display an error page.
 */
if (!did_match()) Errors\notFoundError();
