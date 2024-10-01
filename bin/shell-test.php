<?php


! defined('BASE_PATH') && define('BASE_PATH', dirname(__DIR__, 1));

require BASE_PATH . '/vendor/autoload.php';

$host = "mysql";
$user = 'user_no_ssl';
$password = 'user_no_ssl'; // Add your root password here
$dbname = 'userdb';
$port = 3306;

try {
  $dsn = "mysql:host=$host;dbname=$dbname;port=$port;charset=utf8mb4";
  echo $dsn.PHP_EOL;
  $pdo = new \PDO($dsn, $user, $password, [
    \PDO::MYSQL_ATTR_SSL_CA => "/opt/www/.docker/mysql/certs/ca.pem",
    \PDO::MYSQL_ATTR_SSL_KEY => "/opt/www/.docker/mysql/certs/server-cert.pem",
    \PDO::MYSQL_ATTR_SSL_CERT => "/opt/www/.docker/mysql/certs/server-key.pem",
    \PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false,
    \PDO::ERRMODE_EXCEPTION => true,
  ]);
  echo "Connection Successful!\n";
  $query = "SHOW DATABASES";
  $stmt = $pdo->query($query);

  echo "Tables in database 'test':\n";
  while ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
    echo $row[0] . "\n";
  }

} catch (\Exception $e) {
  echo "Connection failed: " . $e->getMessage() . PHP_EOL;
}
