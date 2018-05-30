-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 30, 2018 at 05:51 PM
-- Server version: 5.6.34-log
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `anonim_voting_registrator`
--

-- --------------------------------------------------------

--
-- Table structure for table `av_groups`
--

CREATE TABLE `av_groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `av_groups`
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
-- Table structure for table `av_relations_vote_group`
--

CREATE TABLE `av_relations_vote_group` (
  `id` int(10) UNSIGNED NOT NULL,
  `vote_id` int(10) UNSIGNED NOT NULL,
  `group_id` int(10) UNSIGNED NOT NULL,
  `public_key` text NOT NULL,
  `private_key` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `av_users`
--

CREATE TABLE `av_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `hash` varchar(255) DEFAULT NULL,
  `status` smallint(6) NOT NULL,
  `group_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `av_users`
--

INSERT INTO `av_users` (`id`, `email`, `name`, `password`, `hash`, `status`, `group_id`) VALUES
(2, 'anna.titova94@mail.ru', 'Анна Титова', '130da2141f710c9d70c7e572c3aa8426', NULL, 1, 7),
(3, 'vovchik.titov@mail.ru', 'Владимир Титов', '130da2141f710c9d70c7e572c3aa8426', '5d62a615ae9162a1fd76ce9bb4f7f842', 1, 2),
(4, 'titan797@yandex.ru', 'Джефферсон Фарфан', 'f584dfcef58674f69abdf2e7d13489ce', NULL, 1, 1),
(5, 'miranchyk@fclm.ru', 'Алексей Миранчук', '56f3c92f8f6833e8f52b0e322a5e1559', NULL, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `av_votes`
--

CREATE TABLE `av_votes` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `bulletin` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `av_groups`
--
ALTER TABLE `av_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `av_relations_vote_group`
--
ALTER TABLE `av_relations_vote_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `av_users`
--
ALTER TABLE `av_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `av_votes`
--
ALTER TABLE `av_votes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `av_groups`
--
ALTER TABLE `av_groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `av_relations_vote_group`
--
ALTER TABLE `av_relations_vote_group`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `av_users`
--
ALTER TABLE `av_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `av_votes`
--
ALTER TABLE `av_votes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
