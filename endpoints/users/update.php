<?php

use function Auth\checkAuthUser;
use function Auth\checkUserEditRight;
use function Database\pdo;
use function Siler\Http\redirect;
use function Siler\Http\Request\post;
use function Siler\Http\setsession;
use function Validators\setErrorAndRedirect;
use function Validators\validCSRFToken;
use function Validators\validPassword;

$id = $params['id'];

checkAuthUser();
validCSRFToken();
checkUserEditRight($id);

$password = validPassword(post('password'), post('password_check'));

$success = pdo()
    ->prepare(
        'UPDATE users SET password = :password
        WHERE id=:id'
    )
    ->execute(compact('id', 'password'));

if(!$success){
    setErrorAndRedirect('Update failed');
}
setsession('infoAlert', 'Update successfull');
redirect("/users/$id");
