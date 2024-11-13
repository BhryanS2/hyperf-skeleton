#!/usr/bin/env php
<?php

ini_set('display_errors', 'on');
ini_set('display_startup_errors', 'on');
ini_set('memory_limit', '1G');
ini_set('trace_flags', 0);

error_reporting(E_ALL);
date_default_timezone_set('America/Sao_Paulo');

use Swoole\Database\PDOPool;
use Swoole\Database\PDOConfig;

Swoole\Runtime::enableCoroutine();  // Enable coroutine support for native PHP clients

Swoole\Coroutine::set([
    'log_level' => SWOOLE_LOG_NONE,
    'trace_flags' => 0
]);

Swoole\Coroutine::create(function () {
  // PDO Config with SSL and timeout settings
  $pdoConfig = (new PDOConfig())
      ->withHost('mysql')
      ->withPort(3306)
      ->withDbName('userdb')
      ->withCharset('utf8mb4')
      ->withUsername('user_no_ssl')
      ->withPassword('user_no_ssl')
      ->withOptions([
          PDO::MYSQL_ATTR_SSL_CA    => '/var/www/.docker/mysql/certs/ca.pem',
          PDO::MYSQL_ATTR_SSL_CERT  => '/var/www/.docker/mysql/certs/server-cert.pem',
          PDO::MYSQL_ATTR_SSL_KEY   => '/var/www/.docker/mysql/certs/server-key.pem',
          PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false,
          PDO::ATTR_TIMEOUT         => 5,  // Connection timeout
          PDO::ATTR_ERRMODE         => PDO::ERRMODE_EXCEPTION,
      ]);

  $pool = new PDOPool($pdoConfig, 10);

  $pdo = $pool->get();

  if (!$pdo) {
      echo "Failed to get a connection from the pool.\n";
      return;
  }

  $statement = $pdo->query("SELECT VERSION()");
  $result = $statement->fetch();

  print_r($result);

  $pool->put($pdo);
});


Swoole\Coroutine::create(function () {
  $pdoConfig = (new PDOConfig())
      ->withHost('mysql')
      ->withPort(3306)
      ->withDbName('userdb')
      ->withCharset('utf8mb4')
      ->withUsername('user_ssl')
      ->withPassword('user_ssl')
      ->withOptions([
          PDO::MYSQL_ATTR_SSL_CA    => '/var/www/.docker/mysql/certs/ca.pem',
          PDO::MYSQL_ATTR_SSL_CERT  => '/var/www/.docker/mysql/certs/server-cert.pem',
          PDO::MYSQL_ATTR_SSL_KEY   => '/var/www/.docker/mysql/certs/server-key.pem',
          PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false,
          PDO::ATTR_TIMEOUT         => 5,
          PDO::ATTR_ERRMODE         => PDO::ERRMODE_EXCEPTION,
      ]);

  $pool = new PDOPool($pdoConfig, 10);

  $pdo = $pool->get();

  if (!$pdo) {
      echo "Failed to get a connection from the pool.\n";
      return;
  }


  $statement = $pdo->query("SELECT VERSION()");
  $result = $statement->fetch();

  print_r($result);

  $pool->put($pdo);
});
