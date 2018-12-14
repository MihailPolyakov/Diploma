-- Adminer 4.2.4 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mail` varchar(50) NULL,
  `privilege` varchar(50) NOT NULL,
  `data` datetime NOT NULL DEFAULT NOW(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO users (login, password, privilege) VALUES ('admin', 'admin', 'admin');

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(50) NOT NULL,
  `data` timestamp NOT NULL DEFAULT NOW(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `questions`;
CREATE TABLE `questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` text(10000) NOT NULL,
  `data` timestamp NOT NULL DEFAULT NOW(),
  `id_user` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `answers`;
CREATE TABLE `answers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `answer` text(10000) NOT NULL,
  `data` timestamp NOT NULL DEFAULT NOW(),
  `id_question` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- 2016-04-15 20:07:14