<?php

use function Auth\canUserEditPlaylist;
use function Auth\checkAuthUser;
use function Database\deletePlaylist;
use function Siler\Http\Response\redirect;
use function Siler\Http\setsession;
use function Validators\setErrorAndRedirect;
use function Validators\validCSRFToken;
use function Validators\validPlaylistId;

$id = (int) $params['id'];

checkAuthUser();
validCSRFToken();

validPlaylistId($id);
canUserEditPlaylist($id);

$success = deletePlaylist($id);

if (!$success) {
    setErrorAndRedirect('Delete failed');
}
setsession('infoAlert', 'Delete successfull');
redirect("/playlists");
