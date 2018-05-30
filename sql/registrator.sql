-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Май 25 2018 г., 22:52
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `anonim_voting`
--
CREATE DATABASE `anonim_voting` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `anonim_voting`;

-- --------------------------------------------------------

--
-- Структура таблицы `av_groups`
--

CREATE TABLE IF NOT EXISTS `av_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Дамп данных таблицы `av_groups`
--

INSERT INTO `av_groups` (`id`, `name`) VALUES
(3, 'ИТ-11'),
(4, 'ИТ-12'),
(5, 'ИТ-21'),
(6, 'ИТ-31'),
(7, 'ИТ-41'),
(1, 'МИТ-11'),
(2, 'МИТ-21'),
(8, 'ПИ-11');

-- --------------------------------------------------------

--
-- Структура таблицы `av_relations_vote_group`
--

CREATE TABLE IF NOT EXISTS `av_relations_vote_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `vote_id` int(10) unsigned NOT NULL,
  `group_id` int(10) unsigned NOT NULL,
  `public_key` text NOT NULL,
  `private_key` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `av_users`
--

CREATE TABLE IF NOT EXISTS `av_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `hash` varchar(255) DEFAULT NULL,
  `status` smallint(6) NOT NULL,
  `group_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `av_users`
--

INSERT INTO `av_users` (`id`, `email`, `name`, `password`, `hash`, `status`, `group_id`) VALUES
(2, 'anna.titova94@mail.ru', 'Анна Титова', '130da2141f710c9d70c7e572c3aa8426', NULL, 1, 7),
(3, 'vovchik.titov@mail.ru', 'Владимир Титов', '130da2141f710c9d70c7e572c3aa8426', '5d62a615ae9162a1fd76ce9bb4f7f842', 1, 2),
(4, 'titan797@yandex.ru', 'Джефферсон Фарфан', 'f584dfcef58674f69abdf2e7d13489ce', NULL, 1, 1),
(5, 'miranchyk@fclm.ru', 'Алексей Миранчук', '56f3c92f8f6833e8f52b0e322a5e1559', NULL, 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `av_votes`
--

CREATE TABLE IF NOT EXISTS `av_votes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `bulletin` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
