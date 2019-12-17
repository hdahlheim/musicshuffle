<?php

use function Siler\Functional\puts;
use function Siler\Route\get;
use function Siler\Route\post;
use function Siler\Route\resource;

get('/', puts('chello'));

get('/login', '../endpoints/login.php');
post('/login', '../endpoints/auth_user.php');
post('/logout', '../endpoints/logout.php');
get('/register', '../endpoints/register.php');


resource('/users', '../endpoints/users');
resource('/playlists', '../endpoints/playlists');
