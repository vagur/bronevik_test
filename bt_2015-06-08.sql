# ************************************************************
# Sequel Pro SQL dump
# Версия 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Адрес: localhost (MySQL 5.5.33)
# Схема: bt
# Время создания: 2015-06-08 10:26:05 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Дамп таблицы employers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `employers`;

CREATE TABLE `employers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `lastname` varchar(255) NOT NULL DEFAULT '',
  `firstname` varchar(255) NOT NULL DEFAULT '',
  `pname` varchar(255) NOT NULL DEFAULT '',
  `jobtitle` varchar(255) NOT NULL DEFAULT '',
  `gender` enum('M','F') DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `passport` varchar(10) DEFAULT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `employers` WRITE;
/*!40000 ALTER TABLE `employers` DISABLE KEYS */;

INSERT INTO `employers` (`id`, `lastname`, `firstname`, `pname`, `jobtitle`, `gender`, `birthdate`, `passport`, `phone`, `email`, `deleted`)
VALUES
	(6,'Вагуров','Евгений','Сергеевич','наркоборон','M','2015-06-08','3333333333','9655334676','mail@vagurov.ru',0),
	(7,'Иванов','Евгений','Михалыч','босс','M','2015-06-12','6666666666','3433656644','vagurov@positivesoft.ru',1);

/*!40000 ALTER TABLE `employers` ENABLE KEYS */;
UNLOCK TABLES;


# Дамп таблицы employers_history
# ------------------------------------------------------------

DROP TABLE IF EXISTS `employers_history`;

CREATE TABLE `employers_history` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `employer_id` int(11) unsigned NOT NULL,
  `version` int(11) unsigned NOT NULL,
  `lastname` varchar(255) NOT NULL DEFAULT '',
  `firstname` varchar(255) NOT NULL DEFAULT '',
  `pname` varchar(255) NOT NULL DEFAULT '',
  `jobtitle` varchar(255) NOT NULL DEFAULT '',
  `gender` enum('M','F') DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `passport` varchar(10) DEFAULT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `employer_id` (`employer_id`,`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `employers_history` WRITE;
/*!40000 ALTER TABLE `employers_history` DISABLE KEYS */;

INSERT INTO `employers_history` (`id`, `employer_id`, `version`, `lastname`, `firstname`, `pname`, `jobtitle`, `gender`, `birthdate`, `passport`, `phone`, `email`, `deleted`)
VALUES
	(8,6,10,'Вагуров','Евгений','Сергеевич','наркоборон','M','2015-06-08','3333333333','9655334676','mail@vagurov.ru',0),
	(9,7,11,'Иванов','Евгений','Сергеевич','упцкупкцуп','M','2015-06-12','6666666666','3433656644','vagurov@positivesoft.ru',0),
	(10,7,12,'Иванов','Евгений','Михалыч','босс','M','2015-06-12','6666666666','3433656644','vagurov@positivesoft.ru',0),
	(11,7,13,'','','','',NULL,NULL,NULL,NULL,NULL,1);

/*!40000 ALTER TABLE `employers_history` ENABLE KEYS */;
UNLOCK TABLES;


# Дамп таблицы log
# ------------------------------------------------------------

DROP TABLE IF EXISTS `log`;

CREATE TABLE `log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `type` enum('C','U','D') DEFAULT NULL,
  `employer_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `employer_id` (`employer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `log` WRITE;
/*!40000 ALTER TABLE `log` DISABLE KEYS */;

INSERT INTO `log` (`id`, `type`, `employer_id`)
VALUES
	(10,'C',6),
	(11,'C',7),
	(12,'U',7),
	(13,'U',7),
	(14,'D',7);

/*!40000 ALTER TABLE `log` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
