<?php

/**
 *  Global Settings Array
 */
return [
    'db' => [
        'host' => isset($_ENV['docker']) ? 'db' : '127.0.0.1',
        'name' => getenv('DB_NAME'),
        'user' => getenv('DB_USER'),
        'pwd' => getenv('DB_PASSWORD'),
    ],
];
