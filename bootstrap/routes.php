<?php

use function Siler\Functional\puts;
use function Siler\Route\get;
use function Siler\Route\resource;

get('/', puts('chello'));

resource('/users', '../endpoints/users');
resource('/playlists', '../endpoints/playlists');
