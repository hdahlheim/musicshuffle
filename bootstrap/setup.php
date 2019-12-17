<?php

use Siler\Twig;

use function Siler\Http\flash;

$dotenv = Dotenv\Dotenv::create(__DIR__.'/..');
$dotenv->load();

$twigEnv = Twig\init('../resources/templates/');
$twigEnv->addGlobal('errorAlert', flash('errorAlert'));
$twigEnv->addGlobal('infoAlert', flash('infoAlert'));

