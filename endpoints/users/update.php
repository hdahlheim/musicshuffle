<?php

use function Auth\checkAuthUser;
use function Auth\canUserEditUser;
use function Database\updateUserPassword;
use function Siler\Http\redirect;
use function Siler\Http\Request\post;
use function Siler\Http\setsession;
use function Validators\setErrorAndRedirect;
use function Validators\validCSRFToken;
use function Validators\validPassword;

$id = (int) $params['id'];

checkAuthUser();
validCSRFToken();
canUserEditUser($id);

$password = validPassword(post('password'), post('password_check'));

$success = updateUserPassword($id, $password);

if (!$success) {
    setErrorAndRedirect('Update failed');
}
setsession('infoAlert', 'Update successfull');
redirect("/users/$id");
