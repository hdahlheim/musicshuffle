<?php
use function Database\pdo;
use function Siler\Http\redirect;
use function Siler\Http\Request\post;
use function Siler\Http\Response\html;
use function Siler\Twig\render;
use function Validators\setErrorAndRedirect;

$username = post('username');
$password = post('password');

$userQuery = pdo()->prepare('SELECT id, username, password FROM users WHERE username = :username');
$userQuery->execute(array('username' => $username));
$user = $userQuery->fetch(PDO::FETCH_ASSOC);

if (password_verify($password, $user['password'])) {
    session_regenerate_id();

    $_SESSION['user_name'] = $username;
    $_SESSION['user_id'] = $user['id'];
    redirect('/');
    exit;
}
else {
    setErrorAndRedirect('Password is wrong');
}
