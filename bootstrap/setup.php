<?php

use Siler\Twig;

use function Siler\Http\flash;

$dotenv = Dotenv\Dotenv::create(__DIR__.'/..');
$dotenv->load();

Twig\init('../resources/templates/')
    ->addGlobal('errorAlert', flash('errorAlert'))
    ->addGlobal('infoAlert', flash('infoAlert'));

