<?php
declare(strict_types=1);

use DI\ContainerBuilder;

return function (ContainerBuilder $containerBuilder) {
    // Global Settings Object
    $containerBuilder->addDefinitions([
        'settings' => [
            'db' => [
                'host' => isset($_ENV['docker']) ? 'db' : '127.0.0.1',
                'name' => getenv('DB_NAME'),
                'user' => getenv('DB_USER'),
                'pwd' => getenv('DB_PASSWORD'),
            ],
            'displayErrorDetails' => true, // Should be set to false in production
        ],
    ]);
};
