<?php

use function Auth\checkAuthUser;
use function Auth\canUserEditUser;
use function Database\getUserById;
use function Siler\Http\Response\html;
use function Siler\Twig\render;
use function Validators\validUserId;

checkAuthUser();

$id = (int) $params['id'];

validUserId($id);
canUserEditUser($id);

$user = getUserById($id);

html(render('users/edit.twig', compact('user')));
