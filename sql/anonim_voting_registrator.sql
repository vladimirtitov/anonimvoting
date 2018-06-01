-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:8889
-- Время создания: Июн 01 2018 г., 16:53
-- Версия сервера: 5.6.35
-- Версия PHP: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- База данных: `anonim_voting_registrator`
--

-- --------------------------------------------------------

--
-- Структура таблицы `av_groups`
--

CREATE TABLE `av_groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
-- Структура таблицы `av_relations_user_subvoting`
--

CREATE TABLE `av_relations_user_subvoting` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `subvoting_id` int(10) UNSIGNED NOT NULL,
  `is_registered` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `av_relations_user_subvoting`
--

INSERT INTO `av_relations_user_subvoting` (`id`, `user_id`, `subvoting_id`, `is_registered`) VALUES
(4, 4, 18, 0),
(5, 5, 18, 0),
(6, 3, 19, 0),
(7, 4, 20, 0),
(8, 5, 20, 0),
(9, 3, 21, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `av_relations_vote_group`
--

CREATE TABLE `av_relations_vote_group` (
  `id` int(10) UNSIGNED NOT NULL,
  `vote_id` int(10) UNSIGNED NOT NULL,
  `group_id` int(10) UNSIGNED NOT NULL,
  `public_key` text NOT NULL,
  `private_key` text NOT NULL,
  `max_vote` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `registrator_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `av_relations_vote_group`
--

INSERT INTO `av_relations_vote_group` (`id`, `vote_id`, `group_id`, `public_key`, `private_key`, `max_vote`, `registrator_id`) VALUES
(18, 16, 1, '-----BEGIN PUBLIC KEY-----\nMFwwDQYJKoZIhvcNAQEBBQADSwAwSAJBALjIlBoVQTR3WnbAEBQllX7gJJhkayto\nPdxEq+7McmhD5O4m1XVJ+ra2nV+3YpW8ioQAE10rd40hgMFUviGQ5lECAwEAAQ==\n-----END PUBLIC KEY-----\n', '-----BEGIN PRIVATE KEY-----\nMIIBVAIBADANBgkqhkiG9w0BAQEFAASCAT4wggE6AgEAAkEAuMiUGhVBNHdadsAQ\nFCWVfuAkmGRrK2g93ESr7sxyaEPk7ibVdUn6tradX7dilbyKhAATXSt3jSGAwVS+\nIZDmUQIDAQABAkEAnYep8v6RwyfJQJmGW5aa9zohGKXrU2sf6avFo+Q52LYtlBaF\nENXWTNLHytq9ImYtww2SzG5QxexDMNF4WN2IwQIhAOVix468ehnY5uUJrIdXu+yo\nNjHp+BCtKxzJbB1/QwkZAiEAzjkFDT1DjMi2BFNMyWBcfBMT7kePu4Mc7KmO7zRO\nFfkCIEWGoyXIStn6vEE/pWOAXB1m/sYyPFYRprea9YIbSJ5BAiAp7EeNoHW6CheO\nm4yRp6hFhO9ZUmzy1r2rkvC+yihRqQIgW3KOnPgMHKxGgrg9IwvjHUGY7wfbvqjo\n3FMhA9sYrz4=\n-----END PRIVATE KEY-----\n', 3, 65),
(19, 16, 2, '-----BEGIN PUBLIC KEY-----\nMFwwDQYJKoZIhvcNAQEBBQADSwAwSAJBAMXnNkwHtCipabJkc4hmHzbERrbrkILH\nh+BSTbDihUb5IWOSIU6UXwuLuo+BQtdzto1MMIZKeMJPNjkrw32wg8MCAwEAAQ==\n-----END PUBLIC KEY-----\n', '-----BEGIN PRIVATE KEY-----\nMIIBVgIBADANBgkqhkiG9w0BAQEFAASCAUAwggE8AgEAAkEAxec2TAe0KKlpsmRz\niGYfNsRGtuuQgseH4FJNsOKFRvkhY5IhTpRfC4u6j4FC13O2jUwwhkp4wk82OSvD\nfbCDwwIDAQABAkEApzFRvuPXQW72u95/eKGGB1fEwi67FLGLSmld92032Z+NSOoS\nq8ONBfykkqgeYb2nlE23oiK56/NN72K7JFXBoQIhAORhHjs88aOMBiTEILdTTxYl\nDbo2Vgu9K48yH1C/FkYzAiEA3daESXhESjOIcKMWczuy6iVjflzj5Vk6tOslbEfC\nnDECIQCWmZiG9dRexgqTGiZ83doMP1kDD6vER/W+kw3lgG0e0wIgDzSA5LhFlgBq\nPa4v/737yWi+pQ6g4Dt5dqUXb5CLmkECIQC+ARYyzT+B7awrioJWXpvExMc81l2d\nlnAfsR7pxFORmw==\n-----END PRIVATE KEY-----\n', 5, 66),
(20, 17, 1, '-----BEGIN PUBLIC KEY-----\nMFwwDQYJKoZIhvcNAQEBBQADSwAwSAJBAKzFcRPREcoZvBhInnPRs6rMc/fkCauZ\nphCSPKPavqt3aG10+4aAe7BbAta+ATa1BVe8fRr4WnOr8pSpT0jrFO8CAwEAAQ==\n-----END PUBLIC KEY-----\n', '-----BEGIN PRIVATE KEY-----\nMIIBUwIBADANBgkqhkiG9w0BAQEFAASCAT0wggE5AgEAAkEArMVxE9ERyhm8GEie\nc9Gzqsxz9+QJq5mmEJI8o9q+q3dobXT7hoB7sFsC1r4BNrUFV7x9Gvhac6vylKlP\nSOsU7wIDAQABAkBtSmSyhXF8Z/UdY2qgl0nRRI4jhKQ9Ye+z0d38RNaSfed3COEF\nA7AFsugb1UK4Y5SkuDYRKesr5qoLgoojDbKhAiEA1qBiIAaW3/0zmYe21ZMw5m8H\nKKCi/4e739IqmhdyV58CIQDOE4qdz7PUSr8KnZXDB2u14attLpii/fUpcJEP8dOA\nsQIgeVF9RecTn5crdKxvH/ismoTGAiQTHuflvdW5uRJp0rcCIBieIwAJMO1aZIoL\nGznqKAbZR5ZKa7eE6QWjSeECvYZxAiAZnlVVpkg5LNait7+ojb02xhUWUNa67AoH\nI6vQPWoJPw==\n-----END PRIVATE KEY-----\n', 12, NULL),
(21, 17, 2, '-----BEGIN PUBLIC KEY-----\nMFwwDQYJKoZIhvcNAQEBBQADSwAwSAJBAKDM+YG4AhIkslAEtci1ug6DoGewq9XP\n52e47NJ1DlowWGbs2KU6r6gfold9Kynt0O8Yij2XOK7Y+UGQiP+jlP8CAwEAAQ==\n-----END PUBLIC KEY-----\n', '-----BEGIN PRIVATE KEY-----\nMIIBUwIBADANBgkqhkiG9w0BAQEFAASCAT0wggE5AgEAAkEAoMz5gbgCEiSyUAS1\nyLW6DoOgZ7Cr1c/nZ7js0nUOWjBYZuzYpTqvqB+iV30rKe3Q7xiKPZc4rtj5QZCI\n/6OU/wIDAQABAkB1OPgrOJlJ4Lac3tImn1QjgJFPBdw+4nEvjAAY7HyqAayQuwle\nx6DT5gMb4MJKcVD/fro6OMEn6RasaP5Y2OoBAiEAzuG8Jhb6dxg6WI08wjng0B9W\nyxW6DJFiMGdJu/KCjRkCIQDG+m7M0r8bx5XygNfTL+ciKFInycxkshIkIRgat0Vd\n1wIgL2rDwgMwQw21ichNbcLwSSN1tDR1oR3NYIS7/Kz3yTkCIGpmnntOsr0DJC7S\nMRcQRZOhZhU6tt6dzk+dlssqd6BvAiB/uscmJNVBOP6xwelaVlMGKyqQAS4LvMPH\nEf7fYVLqrQ==\n-----END PRIVATE KEY-----\n', 1, NULL),
(22, 17, 3, '-----BEGIN PUBLIC KEY-----\nMFwwDQYJKoZIhvcNAQEBBQADSwAwSAJBAMno4j50e91EauQuOFvSb4WbcnH6K/uK\nsMuUpFtqZPrcGWjkzmNF9UOwR96BDDAxNf4gLVIQk1MNtU21NiwVj1kCAwEAAQ==\n-----END PUBLIC KEY-----\n', '-----BEGIN PRIVATE KEY-----\nMIIBVgIBADANBgkqhkiG9w0BAQEFAASCAUAwggE8AgEAAkEAyejiPnR73URq5C44\nW9JvhZtycfor+4qwy5SkW2pk+twZaOTOY0X1Q7BH3oEMMDE1/iAtUhCTUw21TbU2\nLBWPWQIDAQABAkEAoOtCpZQgxBCrQIC12ji1OT7Sz5QbSbcXgKlO9KyvHl6xQ4tO\nct67FqRs5vt8c87mLTI3BiOcjwOgqiHbCKrRoQIhAPW6NAo6QbJzFz0jU7IOjSg9\nuwnT3Yl0jVfkoqu51r53AiEA0lm9a9RqfZpfiww4vsk+7BbtzYsqNAG191HE/3mM\nhK8CIQCwyUwTZ6JIboDznWzjl5B6uR7NjT2/XLkr2PQntEYJNQIgPJuUw3Pxtvz6\n2HKOCxKrKZU1sYqOf2uaxYbu7vlTrosCIQCANEsrqJR3r1nIZXkfeiHm85bL3rB3\nFmH850Xy/K1MDw==\n-----END PRIVATE KEY-----\n', 3, NULL),
(23, 17, 4, '-----BEGIN PUBLIC KEY-----\nMFwwDQYJKoZIhvcNAQEBBQADSwAwSAJBAKEGpc+FejmLBZ2nsIV67IwW6im+px6B\nnVpHn6LWZagDmPhFAHTD+5i65l1jJUFgnLUEEqWiZbOuW3U+Ie0VzN0CAwEAAQ==\n-----END PUBLIC KEY-----\n', '-----BEGIN PRIVATE KEY-----\nMIIBVQIBADANBgkqhkiG9w0BAQEFAASCAT8wggE7AgEAAkEAoQalz4V6OYsFnaew\nhXrsjBbqKb6nHoGdWkefotZlqAOY+EUAdMP7mLrmXWMlQWCctQQSpaJls65bdT4h\n7RXM3QIDAQABAkB793gzeVkNb9/U7cJSIL53YzTHCoXyUGrpk/ZsEI6Wd2WjhRiO\nKej3m7DDc56tTqihCTmQV9BwJHciOUk3JDDBAiEA1CVeKcngE0N5mckFhAIkDpd5\nwHG5pMqqXzXd/FKVKxUCIQDCUAqWzPl8foNPHvFkZVCOkD4GxqPleSF/vXC2BpHs\nqQIgetiApHYv+TezbKgJN539vy1b5WJ1e8WXzrZkqz4u/tkCIQCEUCCFwxl3bmZX\ncAiLhnmuOgYicwyTa0ImS4b+S8b90QIhAIEyc0YZKU5HY9BZEkx+iJBKzC68VVh9\nNCP7ELec3a7K\n-----END PRIVATE KEY-----\n', 5, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `av_users`
--

CREATE TABLE `av_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `hash` varchar(255) DEFAULT NULL,
  `status` smallint(6) NOT NULL,
  `group_id` int(11) NOT NULL DEFAULT '0',
  `is_admin` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `av_users`
--

INSERT INTO `av_users` (`id`, `email`, `name`, `password`, `hash`, `status`, `group_id`, `is_admin`) VALUES
(2, 'anna.titova94@mail.ru', 'Анна Титова', '130da2141f710c9d70c7e572c3aa8426', NULL, 1, 7, 0),
(3, 'vovchik.titov@mail.ru', 'Владимир Титов', '130da2141f710c9d70c7e572c3aa8426', '2332f8de74667b0dae69d0a2315b97fc', 1, 2, 1),
(4, 'titan797@yandex.ru', 'Джефферсон Фарфан', 'f584dfcef58674f69abdf2e7d13489ce', NULL, 1, 1, 0),
(5, 'miranchyk@fclm.ru', 'Алексей Миранчук', '56f3c92f8f6833e8f52b0e322a5e1559', NULL, 1, 1, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `av_votes`
--

CREATE TABLE `av_votes` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `bulletin` text NOT NULL,
  `date_start` datetime NOT NULL,
  `date_end` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `av_votes`
--

INSERT INTO `av_votes` (`id`, `name`, `description`, `bulletin`, `date_start`, `date_end`) VALUES
(16, 'Футболист года', 'Выборы лучшего футболиста года', '[{\"name\":\"\\u041b\\u0435\\u043e \\u041c\\u0435\\u0441\\u0441\\u0438\",\"vote\":0},{\"name\":\"\\u041a\\u0432\\u0438\\u043d\\u0441\\u0438 \\u041f\\u0440\\u043e\\u043c\\u0435\\u0441\",\"vote\":0},{\"name\":\"\\u041b\\u043e\\u0440\\u0438\\u0441 \\u041a\\u0430\\u0440\\u0438\\u0443\\u0441\",\"vote\":0},{\"name\":\"\\u0412\\u043b\\u0430\\u0434\\u0438\\u043c\\u0438\\u0440 \\u0422\\u0438\\u0442\\u043e\\u0432\",\"vote\":0}]', '2018-06-02 15:00:00', '2018-06-03 15:00:00'),
(17, 'Тестовое голосование', 'Вот так вот', '[{\"name\":\"\\u041f\\u0443\\u0442\\u0438\\u043d\",\"vote\":0},{\"name\":\"\\u0411\\u0443\\u0448\",\"vote\":0},{\"name\":\"\\u0421\\u0430\\u0440\\u043a\\u043e\\u0437\\u0438\",\"vote\":0},{\"name\":\"\\u0413\\u0440\\u0435\\u0439\",\"vote\":0}]', '2019-02-13 23:05:00', '2019-02-13 23:50:00');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `av_groups`
--
ALTER TABLE `av_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Индексы таблицы `av_relations_user_subvoting`
--
ALTER TABLE `av_relations_user_subvoting`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `av_relations_vote_group`
--
ALTER TABLE `av_relations_vote_group`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `av_users`
--
ALTER TABLE `av_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Индексы таблицы `av_votes`
--
ALTER TABLE `av_votes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `av_groups`
--
ALTER TABLE `av_groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `av_relations_user_subvoting`
--
ALTER TABLE `av_relations_user_subvoting`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT для таблицы `av_relations_vote_group`
--
ALTER TABLE `av_relations_vote_group`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT для таблицы `av_users`
--
ALTER TABLE `av_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `av_votes`
--
ALTER TABLE `av_votes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;