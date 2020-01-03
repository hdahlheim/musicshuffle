<?php

use function Database\upvoteSong;
use function Siler\Http\Response\redirect;

$playlist_id = $params['id'];
$song_id = $params['songid'];

upvoteSong($playlist_id, $song_id);

redirect("/playlists/$playlist_id");
