# Sequel Pro dump
# Version 1630
# http://code.google.com/p/sequel-pro
#
# Host: localhost (MySQL 5.1.38)
# Database: vteer_dev
# Generation Time: 2010-04-16 00:41:07 -0700
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
  `token` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;



# Dump of table mail_attachments
# ------------------------------------------------------------

DROP TABLE IF EXISTS `mail_attachments`;

CREATE TABLE `mail_attachments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) NOT NULL,
  `type` varchar(30) NOT NULL,
  `size` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;



# Dump of table mail_template_versions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `mail_template_versions`;

CREATE TABLE `mail_template_versions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `templateid` int(11) NOT NULL,
  `datecreated` datetime DEFAULT NULL,
  `subject` varchar(255) NOT NULL,
  `html` longtext NOT NULL,
  `plaintext` longtext NOT NULL,
  `creator` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `IDX_TEMPLATEID` (`templateid`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8;



# Dump of table mail_templates
# ------------------------------------------------------------

DROP TABLE IF EXISTS `mail_templates`;

CREATE TABLE `mail_templates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(100) DEFAULT NULL,
  `recurrence` varchar(50) DEFAULT NULL,
  `allowdupes` tinyint(4) NOT NULL DEFAULT '0',
  `recipient` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `IDX_ROLE` (`role`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;



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
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;



# Dump of table mails_sent
# ------------------------------------------------------------

DROP TABLE IF EXISTS `mails_sent`;

CREATE TABLE `mails_sent` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) DEFAULT NULL,
  `templateverid` int(11) DEFAULT NULL,
  `sent` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_SENT` (`sent`),
  KEY `IDX_USERID` (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8;



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
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;



# Dump of table templatevers_to_attachments
# ------------------------------------------------------------

DROP TABLE IF EXISTS `templatevers_to_attachments`;

CREATE TABLE `templatevers_to_attachments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `templateverid` int(11) NOT NULL,
  `attachmentid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `IDX_UNIQUE` (`templateverid`,`attachmentid`),
  KEY `IDX_TEMPLATEVERID` (`templateverid`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;



# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `email` varchar(255) NOT NULL DEFAULT '',
  `status` int(8) NOT NULL DEFAULT '0',
  `password` varchar(255) DEFAULT NULL,
  `laststatuschange` datetime DEFAULT NULL,
  `submitdate` datetime DEFAULT NULL,
  `data` longtext,
  `arrivaldate` date DEFAULT NULL,
  `departuredate` date DEFAULT NULL,
  `travelnotes` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `IDX_EMAIL` (`email`),
  KEY `IDX_STATUS` (`status`),
  KEY `IDX_ARRIVALDATE` (`arrivaldate`),
  KEY `IDX_DEPARTUREDATE` (`departuredate`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;






/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
