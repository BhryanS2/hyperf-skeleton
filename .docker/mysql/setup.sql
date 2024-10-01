CREATE DATABASE userdb; USE userdb;

DROP TABLE IF EXISTS `example_table`;
CREATE TABLE `example_table` (
  `id` int NOT NULL AUTO_INCREMENT,
  `example_id` int NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

LOCK TABLES `example_table` WRITE;
UNLOCK TABLES;

