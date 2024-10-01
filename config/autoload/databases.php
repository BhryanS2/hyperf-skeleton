<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
use function Hyperf\Support\env;

return [
    'default' => [
        'driver' => env('DB_DRIVER', 'mysql'),
        'host' => "mysql",
        'database' => "userdb",
        'port' => env('DB_PORT', 3306),
        'username' => "user_ssl",
        'password' => "user_ssl",
        'charset' => env('DB_CHARSET', 'utf8'),
        'collation' => env('DB_COLLATION', 'utf8_unicode_ci'),
        "options" => [
            PDO::MYSQL_ATTR_SSL_CA => "/opt/www/.docker/mysql/certs/ca.pem",
            PDO::MYSQL_ATTR_SSL_KEY => "/opt/www/.docker/mysql/certs/server-cert.pem",
            PDO::MYSQL_ATTR_SSL_CERT => "/opt/www/.docker/mysql/certs/server-key.pem",
            PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false,
            PDO::ERRMODE_EXCEPTION => true,
        ],
    ],
    'no_ssl' => [
        'driver' => env('DB_DRIVER', 'mysql'),
        'host' => "mysql",
        'database' => "userdb",
        'port' => env('DB_PORT', 3306),
        'username' => "user_no_ssl",
        'password' => "user_no_ssl",
        'charset' => env('DB_CHARSET', 'utf8'),
        'collation' => env('DB_COLLATION', 'utf8_unicode_ci'),
    ],
];
