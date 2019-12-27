<?php

use function Auth\checkAuthUser;
use function Siler\Route\get;
use function Siler\Route\post;
use function Siler\Route\resource;

get('/login', '../endpoints/login.php');
post('/login', '../endpoints/auth_user.php');
post('/logout', '../endpoints/logout.php');
get('/logout', '../endpoints/logout.php');
get('/register', '../endpoints/register.php');

get('/', '../endpoints/home.php');

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
