<?php

use function Siler\Http\Response\html;
use function Siler\Twig\render;
use function Auth\checkAuthUser;
use function Database\countOf;
use function Database\getAllUsers;
use function Siler\Container\get;

checkAuthUser();

$limit = 10;
$page = (int) get('p', 1);
$start = $limit * ($page - 1);

$users = getAllUsers($limit, $start);
$total = countOf('users');

/**
 * The compact() function creates a key value array, render() puts the generated
 * array in the twig template and html() makes/sends it as a proper response
 * (header response)
 */
html(render('users/index.twig', compact('users', 'page', 'limit', 'total')));
