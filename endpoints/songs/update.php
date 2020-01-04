<?php

use function Auth\checkAuthUser;
use function Database\upVoteSong;
use function Siler\Http\Response\redirect;
use function Siler\Http\session;
use function Validators\validPlaylistId;

checkAuthUser();

$playlistId = (int) $params['id'];


redirect("/playlists/$playlistId");
