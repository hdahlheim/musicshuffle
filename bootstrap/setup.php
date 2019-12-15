<?php

use Siler\Twig;

$dotenv = Dotenv\Dotenv::create(__DIR__.'/..');
$dotenv->load();

Twig\init('../resources/templates/');
var_dump(Database\pdo());

