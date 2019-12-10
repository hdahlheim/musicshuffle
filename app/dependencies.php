<?php
declare(strict_types=1);

use DI\ContainerBuilder;
use Psr\Container\ContainerInterface;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        "db" => function (ContainerInterface $c) {
            $dbsettings = $c->get('settings')['db'];
            $host = $dbsettings['host'];
            $db = $dbsettings['name'];
            $user = $dbsettings['user'];
            $pwd = $dbsettings['pwd'];

            return new PDO("mysql:host=$host;dbname=$db;charset=UTF8", $user , $pwd);
        },
        'view' => function (ContainerInterface $c) {
            $view = new \Slim\Views\Twig(__DIR__ . '/../resources/templates/', [
            ]);

            // $view->addExtension(new Knlv\Slim\Views\TwigMessages(
            //         new Slim\Flash\Messages()
            //     )
            // );

            return $view;
        }
    ]);
};
