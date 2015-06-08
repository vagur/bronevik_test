# ************************************************************
# Sequel Pro SQL dump
# Версия 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Адрес: localhost (MySQL 5.5.33)
# Схема: bt
# Время создания: 2015-06-08 13:31:22 +0000
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
	(9,'Вагуров','Евгений','Сергеевич','наркоборон','M','1983-08-21','1111111111','9655334676','mail@vagurov.ru',0),
	(10,'Иванов','Иван','Иваныч','старший менеджер','M','2016-02-09','2222222222','3333333345','vagurov@positivesoft.ru',1);

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
	(15,9,20,'Вагуров','Евгений','Сергеевич','наркоборон','M','1983-08-21','1111111111','9655334676','mail@vagurov.ru',0),
	(16,10,21,'Иванов','Иван','Иваныч','прораб','M','2016-02-09','2222222222','3333333333','vagurov@positivesoft.ru',0),
	(17,10,22,'Иванов','Иван','Иваныч','старший менеджер','M','2016-02-09','2222222222','3333333345','vagurov@positivesoft.ru',0);

/*!40000 ALTER TABLE `employers_history` ENABLE KEYS */;
UNLOCK TABLES;


# Дамп таблицы log
# ------------------------------------------------------------

DROP TABLE IF EXISTS `log`;

CREATE TABLE `log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `type` enum('C','U','D') DEFAULT NULL,
  `employer_id` int(11) unsigned NOT NULL,
  `dtime` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `employer_id` (`employer_id`),
  KEY `dtime` (`dtime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `log` WRITE;
/*!40000 ALTER TABLE `log` DISABLE KEYS */;

INSERT INTO `log` (`id`, `type`, `employer_id`, `dtime`)
VALUES
	(20,'C',9,'2015-06-08 19:29:33'),
	(21,'C',10,'2015-06-08 19:30:04'),
	(22,'U',10,'2015-06-08 19:30:36'),
	(23,'D',10,'2015-06-08 19:30:57');

/*!40000 ALTER TABLE `log` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
