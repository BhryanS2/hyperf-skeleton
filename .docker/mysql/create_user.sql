CREATE USER 'user_ssl'@'%' IDENTIFIED BY 'user_ssl' REQUIRE X509;
CREATE USER 'user_no_ssl'@'%' IDENTIFIED BY 'user_no_ssl';

CREATE DATABASE if not exists userdb;
GRANT ALL PRIVILEGES ON userdb.* TO 'user_ssl'@'%' WITH GRANT OPTION;
GRANT ALL PRIVILEGES ON userdb.* TO 'user_no_ssl'@'%' WITH GRANT OPTION;

FLUSH PRIVILEGES;
