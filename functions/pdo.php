<?php

namespace Database;
use Siler\Container;

/**
 * Wrapper around the PDO object creation, allways returns a working instance of
 * PDO with the user and password provided in the config file.
 *
 * @return \PDO
 */
function pdo() {
    if (Container\has('PDO_INSTANCE')){
        return Container\get('PDO_INSTANCE');
    }

    $config = require '../bootstrap/settings.php';

    $db_host = $config['db']['host'];
    $db_database = $config['db']['name'];
    $db_user = $config['db']['user'];
    $db_password = $config['db']['pwd'];

    $dsn = "mysql:host={$db_host};dbname={$db_database}";
    try {
        $pdo = new \PDO($dsn, $db_user, $db_password);
        Container\set('PDO_INSTANCE', $pdo);
    } catch (\Throwable $th) {
        Errors\internalServerError();
    }
    return $pdo;
}
