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
-- Database: `anonim_voting_tallier`
--

-- --------------------------------------------------------

--
-- Table structure for table `av_voting_data`
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
-- Dumping data for table `av_voting_data`
--

INSERT INTO `av_voting_data` (`id`, `voter_pub`, `voter_secr`, `bulletin`, `bulletin_encrypted`, `hash_bulletin_encrypted`, `hash_voter_secr_encrypted`, `voting_id`) VALUES
(2, 'ewgwegw', NULL, NULL, NULL, NULL, NULL, '4'),
(6, 'ewgwegw32323', NULL, NULL, NULL, NULL, NULL, '4'),
(13, 'ewgwegw32323sdasdasdas', NULL, NULL, NULL, NULL, NULL, '3'),
(14, 'ewgwegw32323sdasdasdaefwefws', NULL, NULL, NULL, NULL, NULL, '3'),
(15, 'wdqwd', NULL, NULL, NULL, NULL, NULL, '3'),
(16, 'wddsadsqwd', NULL, NULL, NULL, NULL, NULL, '3'),
(17, 'wddsads21qwd', NULL, NULL, NULL, NULL, NULL, '3');

-- --------------------------------------------------------

--
-- Table structure for table `votings`
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
-- Dumping data for table `votings`
--

INSERT INTO `votings` (`id`, `name`, `bulletin`, `date_start`, `date_end`, `max_vote`, `public_key_vote`) VALUES
(2, 'вова', 'ваыв', '2018-05-09 00:00:00', '2018-05-25 00:00:00', 2, ''),
(3, 'Vova', 'Vova', '2016-12-12 21:00:00', '2016-12-12 21:00:00', 5, 'Vova'),
(17, 'Vova', 'Vova', '2016-12-12 21:00:00', '2016-12-12 21:00:00', 5, 'Vova312312'),
(18, 'Vova', 'Vova', '2016-12-12 21:00:00', '2016-12-12 21:00:00', 5, 'Vova3123123232'),
(19, 'Vova', 'Vova', '2016-12-12 21:00:00', '2016-12-12 21:00:00', 5, 'sdfasf');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `av_voting_data`
--
ALTER TABLE `av_voting_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `votings`
--
ALTER TABLE `votings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `av_voting_data`
--
ALTER TABLE `av_voting_data`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `votings`
--
ALTER TABLE `votings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
