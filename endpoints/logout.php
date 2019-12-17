<?php

use function Siler\Http\redirect;

session_destroy();

redirect('/login');
