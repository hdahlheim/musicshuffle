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
    ]);
};
