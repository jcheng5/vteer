# Sequel Pro dump
# Version 1630
# http://code.google.com/p/sequel-pro
#
# Host: localhost (MySQL 5.1.38)
# Database: vteer_dev
# Generation Time: 2010-03-26 01:47:45 -0700
# ************************************************************

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table admins
# ------------------------------------------------------------

DROP TABLE IF EXISTS `admins`;

CREATE TABLE `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;



# Dump of table mail_template_versions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `mail_template_versions`;

CREATE TABLE `mail_template_versions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `templateid` int(11) NOT NULL,
  `datecreated` timestamp NULL DEFAULT NULL,
  `subject` varchar(255) NOT NULL,
  `html` longtext NOT NULL,
  `plaintext` longtext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_TEMPLATEID` (`templateid`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;



# Dump of table mail_templates
# ------------------------------------------------------------

DROP TABLE IF EXISTS `mail_templates`;

CREATE TABLE `mail_templates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `role` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_ROLE` (`role`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;



# Dump of table mails_scheduled
# ------------------------------------------------------------

DROP TABLE IF EXISTS `mails_scheduled`;

CREATE TABLE `mails_scheduled` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `mailid` int(11) NOT NULL,
  `due` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_USERID` (`userid`),
  KEY `IDX_MAILID` (`mailid`),
  KEY `IDX_DUE` (`due`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table mails_sent
# ------------------------------------------------------------

DROP TABLE IF EXISTS `mails_sent`;

CREATE TABLE `mails_sent` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) DEFAULT NULL,
  `templateverid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;



# Dump of table notes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `notes`;

CREATE TABLE `notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `adminid` int(11) NOT NULL,
  `source` varchar(100) DEFAULT NULL,
  `content` text,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_USERID` (`userid`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;



# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `nickname` varchar(100) DEFAULT NULL,
  `email` varchar(255) NOT NULL DEFAULT '',
  `facebookid` bigint(20) unsigned DEFAULT NULL,
  `status` int(8) NOT NULL DEFAULT '0',
  `password` varchar(255) DEFAULT NULL,
  `laststatuschange` datetime DEFAULT NULL,
  `traveldate` datetime DEFAULT NULL,
  `submitdate` datetime DEFAULT NULL,
  `data` longtext,
  PRIMARY KEY (`id`),
  UNIQUE KEY `IDX_EMAIL` (`email`),
  UNIQUE KEY `IDX_FACEBOOKID` (`facebookid`),
  KEY `IDX_STATUS` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;






/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
