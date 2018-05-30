-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:8889
-- Время создания: Май 30 2018 г., 17:04
-- Версия сервера: 5.6.35
-- Версия PHP: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- База данных: `anonim_voting_tallier`
--

-- --------------------------------------------------------

--
-- Структура таблицы `av_voting_data`
--

CREATE TABLE `av_voting_data` (
  `id` int(10) UNSIGNED NOT NULL,
  `voter_pub` text NOT NULL,
  `voter_secr` text,
  `bulletin` text,
  `bulletin_encrypted` text,
  `hash_bulletin_encrypted` text,
  `hash_voter_secr_encrypted` text,
  `voting_id` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `av_voting_data`
--

INSERT INTO `av_voting_data` (`id`, `voter_pub`, `voter_secr`, `bulletin`, `bulletin_encrypted`, `hash_bulletin_encrypted`, `hash_voter_secr_encrypted`, `voting_id`) VALUES
(2, 'ewgwegw', NULL, NULL, NULL, NULL, NULL, '4'),
(6, 'ewgwegw32323', NULL, NULL, NULL, NULL, NULL, '4'),
(13, 'ewgwegw32323sdasdasdas', NULL, NULL, NULL, NULL, NULL, '3'),
(14, 'ewgwegw32323sdasdasdaefwefws', NULL, NULL, NULL, NULL, NULL, '3');

-- --------------------------------------------------------

--
-- Структура таблицы `votings`
--

CREATE TABLE `votings` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `bulletin` text NOT NULL,
  `date_start` datetime NOT NULL,
  `date_end` datetime NOT NULL,
  `max_vote` int(11) NOT NULL,
  `public_key_vote` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `votings`
--

INSERT INTO `votings` (`id`, `name`, `bulletin`, `date_start`, `date_end`, `max_vote`, `public_key_vote`) VALUES
(2, 'вова', 'ваыв', '2018-05-09 00:00:00', '2018-05-25 00:00:00', 2, ''),
(3, 'Vova', 'Vova', '2016-12-12 21:00:00', '2016-12-12 21:00:00', 5, 'Vova'),
(17, 'Vova', 'Vova', '2016-12-12 21:00:00', '2016-12-12 21:00:00', 5, 'Vova312312'),
(18, 'Vova', 'Vova', '2016-12-12 21:00:00', '2016-12-12 21:00:00', 5, 'Vova3123123232');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `av_voting_data`
--
ALTER TABLE `av_voting_data`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `votings`
--
ALTER TABLE `votings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `av_voting_data`
--
ALTER TABLE `av_voting_data`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT для таблицы `votings`
--
ALTER TABLE `votings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;